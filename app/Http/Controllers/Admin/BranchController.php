<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use File;
use Response;
use App\SmsHelper\Sms;

class BranchController extends Controller
{
    public function addBranchForm()
    {
        $executive = DB::table('executive')->where('status',1)->get();
        return view('admin.branch.add_new_branch',compact('executive'));
    }

    public function addBranch(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'executive_id' => 'required|numeric',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:branch'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $branch = DB::table('branch')
            ->insertGetId([
                'name' => $request->input('name'),
                'executive_id' => $request->input('executive_id'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            $branch_id = "F";
            $length = 4 - intval(strlen((string) $branch));
            for ($i=0; $i < $length; $i++) { 
                $branch_id.='0';
            } 
            $branch_id.=$branch;
            DB::table('branch')
                ->where('id',$branch)
                ->update([
                    'branch_id' => $branch_id,
                ]);
            DB::table('wallet')
                ->insert([
                    'user_id' => $branch,
                    'amount' => 0,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $message = urldecode("Welcome to TEAM FISCALE.%0a Your password is ".$request->input('password').".%0aThank you for choosing us.");
            $user_mobile =  $request->input('mobile');
            Sms::SmsSend($user_mobile,$message);
            return redirect()->back()->with('message','Service Point Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function branchList()
    {
        return view('admin.branch.branch_list');
    }

    public function branchListAjax()
    {
        $query = DB::table('branch')
            ->select('branch.*','executive.name as e_name')
            ->leftjoin('executive','executive.id','=','branch.executive_id')
            ->orderBy('branch.id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.edit_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-warning">Edit</a>';
                if ($row->status == '1') {
                    $btn .='<a href="'.route('admin.update_status_branch',['id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger">Deactivate</a>';
                }else{
                    $btn .='<a href="'.route('admin.update_status_branch',['id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-success">Activate</a>';
                }
                $btn .='<a href="'.route('admin.change_pass_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-danger">Change Password</a>
                <a href="'.route('admin.branch_credit_wallet_form',['exe_id'=>encrypt($row->id)]).'" class="btn btn-primary">Credit Wallet</a>                                       
                <a href="'.route('admin.branch_debit_wallet_form',['exe_id'=>encrypt($row->id)]).'" class="btn btn-danger">Debit Wallet</a>
                <a href="'.route('admin.branch_wallet_history',['exe_id'=>encrypt($row->id)]).'" class="btn btn-info">Wallet history</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function editBranchForm($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $executive = DB::table('executive')->where('status',1)->get();
        $branch = DB::table('branch')->where('id',$id)->first();
        return view('admin.branch.branch_edit',compact('branch','executive'));

    }

    public function updateBranch(Request $request)
    {
        $request->validate([
            'executive_id' => 'required|numeric',
            'name' => 'required',
            'id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $branch = DB::table('branch')
            ->where('id',$request->input('id'))
            ->update([
                'executive_id'=>$request->input('executive_id'),
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            return redirect()->back()->with('message','Service Point Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function branchPassChange($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $branch = DB::table('branch')->where('id',$id)->first();

        return view('admin.branch.change_pass',compact('branch'));
    }

    public function branchPassChangeSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'id' => 'required',
        ]);

        $branch = DB::table('branch')
            ->where('id',$request->input('id'))
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            $user_mobile = DB::table('branch')->where('id',$request->input('id'))->first();
            if ($user_mobile) {
                $message = urldecode("Your password has been changed.%0aYour new password is ".$request->input('password').".%0a Thank you for being with us.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            }  
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function updateStatusBranch($id, $status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $branch = DB::table('branch')
            ->where('id',$id)
            ->update([
                'status'=>$status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function debitWalletForm($branch_id)
    {
        try {
            $branch_id = decrypt($branch_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('wallet')
            ->select('wallet.*','branch.name as name','branch.mobile as mobile')
            ->leftjoin('branch','branch.id','=','wallet.user_id')
            ->where('wallet.user_id',$branch_id)
            ->first();
        return view('admin.branch.branch_debit_wallet_form',compact('wallet'));
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

        $wallet_update = DB::table('wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`-".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'transaction_type' => 1,
                    'amount' => $amount,
                    'balance' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $user_mobile = DB::table('branch')->where('id',$wallet_balance->user_id)->first();
            if ($user_mobile) {
                $message = urldecode("Your Wallet has been debited by Rs. $amount.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            }  
        }
        return redirect()->back()->with('message','Wallet Balance Debited From Wallet');

    }

    public function creditWalletForm($branch_id)
    {
        try {
            $branch_id = decrypt($branch_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('wallet')
            ->select('wallet.*','branch.name as name','branch.mobile as mobile')
            ->leftjoin('branch','branch.id','=','wallet.user_id')
            ->where('wallet.user_id',$branch_id)
            ->first();
        return view('admin.branch.branch_credit_wallet_form',compact('wallet'));
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

        $wallet_update = DB::table('wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`+".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'transaction_type' => 2,
                    'amount' => $amount,
                    'balance' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $user_mobile = DB::table('branch')->where('id',$wallet_balance->user_id)->first();
            if ($user_mobile) {
                $message = urldecode("Your Wallet has been credited by Rs. $amount.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            } 
        }
        return redirect()->back()->with('message','Wallet Balance Credited From Wallet');

    }

    public function walletHistory($branch_id)
    {
        try {
            $branch_id = decrypt($branch_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('wallet')
            ->where('user_id',$branch_id)
            ->first();
        $wallet_history = null;
        if ($wallet) {
            $wallet_history = DB::table('wallet_history')
            ->where('wallet_id',$wallet->id)
            ->orderBy('id','desc')
            ->paginate(50);
        }
        return view('admin.branch.branch_wallet_history',compact('wallet','wallet_history'));
    }
}
