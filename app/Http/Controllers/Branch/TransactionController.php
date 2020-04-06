<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Intervention\Image\Facades\Image;
use File;
use Storage;
use App\SmsHelper\Sms;

class TransactionController extends Controller
{
    public function paymentRequestList()
    {
        $branch_id = Auth::guard('branch')->id();
        $p_rqst = DB::table('payment_reqest')->where('branch_id',$branch_id)->get();
        return view('website.branch.transaction.payment_request',compact('p_rqst'));
    }

    public function paymentRequestAddForm()
    {
        return view('website.branch.transaction.add_payment_request');
    }

    public function paymentRequestAdd(Request $request)
    {
        $request->validate([
            'transaction_type' => 'required',
            'bank_name' => 'required',
            'tr_date' => 'required',
            'amount' => 'required|numeric',            
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $fileName = null;
        if ($request->hasfile('image')) {

            $image      = $request->file('image');
            $fileName   = md5(date('now').time())."-".$request->input('name').".".$image->getClientOriginalExtension();

            $img = Image::make($image->getRealPath());
            $img->resize(400, 400, function ($constraint) {
                $constraint->aspectRatio();                 
            });

            $img->stream(); // <-- Key point

            //dd();
            Storage::disk('local')->put('Transaction/'.$fileName, $img);
        }

        $p_rqst = DB::table('payment_reqest')
            ->insert([
                'branch_id' => Auth::guard('branch')->id(),
                'amount' => $request->input('amount'),
                'receipt_image' => $fileName,
                'transaction_type' => $request->input('transaction_type'),
                'bank_name' => $request->input('bank_name'),
                'status' => 1,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back()->with('message','Payment Request Has Been Sent Successfully');
    }

    public function walletHistory()
    {
        $branch_id = Auth::guard('branch')->id();
        $wallet = DB::table('wallet')->where('user_id',$branch_id)->first();
        $wallet_history = null;
        if ($wallet) {
            $wallet_history =  DB::table('wallet_history')->where('wallet_id',$wallet->id)->orderBy('id','desc')->get();
        }
        return view('website.branch.wallet.wallet_history',compact('wallet','wallet_history'));
    }

    public function walletBalanceAddForm()
    {
        return view('website.branch.wallet.add_wallet_balance');
    }

    public function walletBalanceAdd(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:20',
        ]);

        $branch_id = Auth::guard('branch')->id();
        $wallet_order = DB::table('wallet_order')
            ->insertGetId([
                'user_id' => $branch_id,
                'amount' => $request->input('amount'),                
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_order) {
            $user = DB::table('branch')->where('id',$branch_id)->first();
            $user_name = $user->name;
            $user_email = $user->email;
            $user_mobile = $user->mobile;
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );     
            try {
                $response = $api->paymentRequestCreate(array(
                    "purpose" => "Book Purchase Payment",
                    "amount" => $request->input('amount'),
                    "buyer_name" => $user_name,
                    "send_email" => false,
                    "email" => $user_email,
                    "phone" => $user_mobile,
                    "redirect_url" => route('branch.wallet_pay_success',['id'=>encrypt($wallet_order)]),
                    ));
    
                    DB::table('wallet_order')
                        ->where('id',$wallet_order)
                        ->update([
                            'payment_request_id' => $response['id'],
                            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        ]);
                    
                    header('Location: ' . $response['longurl']);
                    exit();
            }catch (Exception $e) {
               abort(404);
            }
        } else {
            return redirect()->back()->with('error','Something Error Occured Please Try Again');
        }        
    }

    public function walletPaySuccess(Request $request,$order_id)
    {
        try {
            $order_id = decrypt($order_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        try {
    
            $api = new \Instamojo\Instamojo(
                config('services.instamojo.api_key'),
                config('services.instamojo.auth_token'),
                config('services.instamojo.url')
            );
     
            $response = $api->paymentRequestStatus(request('payment_request_id'));
     
            if( !isset($response['payments'][0]['status']) ) {
                 return redirect()->route('branch.wallet_balance_add')->with('error','Sorry !! Payment Failed');
            } else if($response['payments'][0]['status'] != 'Credit') {
                return redirect()->route('branch.wallet_balance_add')->with('error','Sorry !! Payment Failed');
            } 
        }catch (\Exception $e) {
            return redirect()->route('branch.wallet_balance_add')->with('error','Sorry !! Payment Failed');
        }
        if($response['payments'][0]['status'] == 'Credit') {
            DB::table('wallet_order')
                ->where('id',$order_id)
                ->where('payment_request_id',$response['id'])
                ->update([
                    'payment_id' => $response['payments'][0]['payment_id'],
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
                $user_mobile = DB::table('branch')->where('id',$wallet_amount->user_id)->first();
                if ($user_mobile) {
                    $message = urldecode("Your Wallet has been credited by Rs.  $wallet_order->amount.");
                    $user_mobile =  $user_mobile->mobile;
                    Sms::SmsSend($user_mobile,$message);
                } 
            }   
            return redirect()->route('branch.wallet_history')->with('message','Wallet Balance Successfully Credited to Your Wallet');
        }else {
            return redirect()->route('branch.wallet_balance_add')->with('error','Sorry !! Payment Failed');
        }
    }
}
