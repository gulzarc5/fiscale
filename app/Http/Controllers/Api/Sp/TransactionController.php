<?php

namespace App\Http\Controllers\Api\Sp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Validator;

class TransactionController extends Controller
{
    public function AddWalletBalance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'amount' => 'required|numeric|min:20',
            'sp_id' => 'required',
        ]);
        
        if ($validator->fails()) { 
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'payment_status' => false,
                'data' => null,
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];  	
            return response()->json($response, 200);
        } 
        $sp_id = $request->input('sp_id');
        $amount = $request->input('amount');
        $wallet_order = DB::table('wallet_order')
            ->insertGetId([
                'user_id' => $sp_id,
                'amount' => $amount,                
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_order) {
            $user = DB::table('branch')->where('id',$sp_id)->first();
            $user_name = $user->name;
            $user_email = $user->email;
            $user_mobile = $user->mobile;

            $data = [
                'purpose' => "Wallet Payment",
                'amount' => $amount,
                'buyer_name' => $user_name,
                'email' => $user_email,
                'phone' => $user_mobile,
                'order_id' => $wallet_order,
            ];

            $response = [
                'status' => true,
                'message' => 'Order Placed Successfully',
                'payment_status' => true,
                'data' => $data,
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200); 

        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'payment_status' => false,
                'data' => null,
                'error_code' => false,
                'error_message' => null,
            ];
            return response()->json($response, 200); 
        }
    }

    public function updatePaymentRequestId($order_id,$payment_request_id)
    {
        $update = DB::table('wallet_order')
            ->where('id',$order_id)
            ->update([
                'payment_request_id' => $payment_request_id,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Payment Request Id Updated',
            ];
            return response()->json($response, 200); 
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
            ];
            return response()->json($response, 200);
        }
        
    }

    public function updatePaymentId($order_id,$payment_request_id,$payment_id)
    {
        DB::table('wallet_order')
            ->where('id',$order_id)
            ->where('payment_request_id',$payment_request_id)
            ->update([
                'payment_id' => $payment_id,
                'status' => '2',
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        $wallet_order =  DB::table('wallet_order')->where('id',$order_id)->first();

        $wallet = DB::table('wallet')
                ->where('user_id',$wallet_order->user_id)
                ->update([
                    'amount' => DB::raw("`amount`+".($wallet_order->amount)),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        if ($wallet) {
            $wallet_amount=DB::table('wallet')->where('user_id',$wallet_order->user_id)->first();
            $wallet_history = DB::table('wallet_history')
                ->insert([
                  'wallet_id' => $wallet_amount->id,
                  'transaction_type' => 2,
                  'amount' => $wallet_order->amount,
                  'balance' => floatval($wallet_amount->amount),
                  'comment' => "Wallet Balance Added Through Online Payment",
                  'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                  'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                  ]);
            $response = [
                'status' => true,
                'message' => 'Wallet Amount Added Successfully',
            ];
            return response()->json($response, 200); 
        } else {
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
            ];
            return response()->json($response, 200); 
        }
        
    }

    public function walletHistory($sp_id)
    {
        $wallet = DB::table('wallet')->where('user_id',$sp_id)->first();
        $wallet->wallet_history = null;
        if ($wallet) {
            $wallet->wallet_history =  DB::table('wallet_history')->where('wallet_id',$wallet->id)->orderBy('id','desc')->get();
        }

        $response = [
            'status' => true,
            'message' => 'Wallet History',
            'data' => $wallet,
        ];
        return response()->json($response, 200); 
    }
}
