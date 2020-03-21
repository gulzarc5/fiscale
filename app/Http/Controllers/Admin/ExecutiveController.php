<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class ExecutiveController extends Controller
{
    public function addExecutiveForm()
    {
        return view('admin.executive.add_new_executive');
    }

    public function addExecutive(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email_id' => ['required', 'string', 'email', 'max:255', 'unique:executive'],
            'mobile' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'gender' => 'required',
        ]);
        $executive = DB::table('executive')
            ->insertGetId([
                'name' => $request->input('name'),
                'email_id' => $request->input('email_id'),
                'mobile' => $request->input('mobile'),
                'password' => Hash::make($request->input('password')),
                'gender' => $request->input('gender'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($executive) {
            DB::table('executive_wallet')
                ->insert([
                    'executive_id'=>$executive,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message','New Executive Added Successfully');
    }

    public function executiveList()
    {
        $executive = DB::table('executive')->get();
        return view('admin.executive.executive_list',compact('executive'));
    }

    public function editExecutiveForm($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $executive = DB::table('executive')->where('id',$id)->first();
        return view('admin.executive.executive_edit',compact('executive'));
    }

    public function updateExecutive(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
        ]);

        DB::table('executive')
            ->where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'gender' => $request->input('gender'),
                'pin' => $request->input('pin'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
            ]);
        return redirect()->back()->with('message','Executive Updated Successfully');
    }

    public function statusUpdateExecutive($id,$status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $executive = DB::table('executive')->where('id',$id)
            ->update([
                'status'=>$status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function executivePassChange($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $executive = DB::table('executive')->where('id',$id)->first();
        return view('admin.executive.change_pass',compact('executive'));
    }

    public function executivePassChangeSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'id' => 'required',
        ]);
        $executive = DB::table('executive')
            ->where('id',$request->input('id'))
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($executive) {
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function debitWalletForm($exe_id)
    {
        try {
            $exe_id = decrypt($exe_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('executive_wallet')
            ->select('executive_wallet.*','executive.name as name','executive.mobile as mobile')
            ->leftjoin('executive','executive.id','=','executive_wallet.executive_id')
            ->where('executive_wallet.executive_id',$exe_id)
            ->first();
        return view('admin.executive.executive_debit_wallet_form',compact('wallet'));
    }

    public function debitWallet(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required',
            'amount' => 'required',
        ]);
        $wallet_id = $request->input('wallet_id');
        $amount = $request->input('amount');
        $comment = $request->input('comment');

        $wallet_update = DB::table('executive_wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`-".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('executive_wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('executive_wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'executive_id' => $wallet_balance->executive_id,
                    'transaction_type' => 2,
                    'amount' => $amount,
                    'total_amount' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message','Wallet Balance Debited From Wallet');

    }

    public function creditWalletForm($exe_id)
    {
        try {
            $exe_id = decrypt($exe_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('executive_wallet')
            ->select('executive_wallet.*','executive.name as name','executive.mobile as mobile')
            ->leftjoin('executive','executive.id','=','executive_wallet.executive_id')
            ->where('executive_wallet.executive_id',$exe_id)
            ->first();
        return view('admin.executive.executive_credit_wallet_form',compact('wallet'));
    }

    public function creditWallet(Request $request)
    {
        $request->validate([
            'wallet_id' => 'required',
            'amount' => 'required',
        ]);
        $wallet_id = $request->input('wallet_id');
        $amount = $request->input('amount');
        $comment = $request->input('comment');

        $wallet_update = DB::table('executive_wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`+".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('executive_wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('executive_wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'executive_id' => $wallet_balance->executive_id,
                    'transaction_type' => 1,
                    'amount' => $amount,
                    'total_amount' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message','Wallet Balance Credited From Wallet');

    }

    public function walletHistory($exe_id)
    {
        try {
            $exe_id = decrypt($exe_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('executive_wallet')
            ->where('executive_id',$exe_id)
            ->first();
        $wallet_history = DB::table('executive_wallet_history')
            ->where('executive_id',$exe_id)
            ->orderBy('id','desc')
            ->paginate(50);
        return view('admin.executive.executive_wallet_history',compact('wallet','wallet_history'));
    }
}
