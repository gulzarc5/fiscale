<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use App\SmsHelper\Sms;

class EmployeeController extends Controller
{
    public function addEmployeeForm()
    {
        return view('admin.employee.add_new_employee');
    }

    public function addEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:employee'],
            'password' => ['required', 'string', 'min:8'],
            'gender' => 'required',
            'password' => 'required',
        ]);

        $employee = DB::table('employee')
            ->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'gender' => $request->input('gender'),
                'designation' => $request->input('designation'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($employee) {
            DB::table('employee_wallet')
            ->insert([
                'emp_id'=>$employee,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            $message = urldecode("Welcome to TEAM FISCALE.%0a Your password is ".$request->input('password').".%0aThank you for choosing us.");
            $user_mobile =  $request->input('mobile');
            Sms::SmsSend($user_mobile,$message);
            return redirect()->back()->with('message','Employee Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function employeeList()
    {
        $employee = DB::table('employee')->orderBy('id','desc')->get();
        $year = Carbon::now()->setTimezone('Asia/Kolkata')->format('Y');
        foreach ($employee as $key => $value) {
            $value->completed_job = DB::table('job')                
                ->where('job.status',4)
                ->whereYear('completed_date', '=', $year)
                ->where('assign_to_id',$value->id)
                ->count();
            $value->open_job = DB::table('job')                
                ->where('job.status','<',3)
                ->where('assign_to_id',$value->id)
                ->where('employee_assignment_status',1)
                ->count();
            $value->correction = DB::table('job')                
                ->where('job.status',3)
                ->where('assign_to_id',$value->id)
                ->where('employee_assignment_status',1)
                ->count();
            $wallet = DB::table('employee_wallet')  
                ->select('amount')              
                ->where('emp_id',$value->id)
                ->first();            
            $value->wallet_balance = $wallet->amount;
        }
        return view('admin.employee.employee_list',compact('employee'));
    }

    public function editEmployeeForm($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $employee = DB::table('employee')->where('id',$id)->first();
        return view('admin.employee.employee_edit',compact('employee'));

    }

    public function updateEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
            'gender' => 'required',
        ]);

        $employee = DB::table('employee')
            ->where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'gender' => $request->input('gender'),
                'designation' => $request->input('designation'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($employee) {
            return redirect()->back()->with('message','Employee Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function employeePassChange($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $employee = DB::table('employee')->where('id',$id)->first();

        return view('admin.employee.change_pass',compact('employee'));
    }

    public function employeePassChangeSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'id' => 'required',
        ]);

        $employee = DB::table('employee')
            ->where('id',$request->input('id'))
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($employee) {
            $user_mobile = DB::table('employee')->where('id',$request->input('id'))->first();
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

    public function statusUpdateEmployee($id,$status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $employee = DB::table('employee')->where('id',$id)
            ->update([
                'status'=>$status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function debitWalletForm($emp_id)
    {
        try {
            $emp_id = decrypt($emp_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('employee_wallet')
            ->select('employee_wallet.*','employee.name as name','employee.mobile as mobile')
            ->leftjoin('employee','employee.id','=','employee_wallet.emp_id')
            ->where('employee_wallet.emp_id',$emp_id)
            ->first();
        return view('admin.employee.employee_debit_wallet_form',compact('wallet'));
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

        $wallet_update = DB::table('employee_wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`-".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('employee_wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('employee_wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'employee_id' => $wallet_balance->emp_id,
                    'transaction_type' => 2,
                    'amount' => $amount,
                    'total_amount' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $user_mobile = DB::table('employee')->where('id',$wallet_balance->emp_id)->first();
            if ($user_mobile) {
                $message = urldecode("Your Wallet has been debited by Rs. $amount.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            }  
        }
        return redirect()->back()->with('message','Wallet Balance Debited From Wallet');

    }

    public function creditWalletForm($emp_id)
    {
        try {
            $emp_id = decrypt($emp_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('employee_wallet')
            ->select('employee_wallet.*','employee.name as name','employee.mobile as mobile')
            ->leftjoin('employee','employee.id','=','employee_wallet.emp_id')
            ->where('employee_wallet.emp_id',$emp_id)
            ->first();
        return view('admin.employee.employee_credit_wallet_form',compact('wallet'));
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

        $wallet_update = DB::table('employee_wallet')
            ->where('id',$wallet_id)
            ->update([
                'amount' => DB::raw("`amount`+".($amount)),                    
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($wallet_update) {
            $wallet_balance = DB::table('employee_wallet')->where('id',$wallet_id)->first();
            $wallet_history_insert = DB::table('employee_wallet_history')
                ->insertGetId([
                    'wallet_id' => $wallet_balance->id,
                    'employee_id' => $wallet_balance->emp_id,
                    'transaction_type' => 1,
                    'amount' => $amount,
                    'total_amount' => $wallet_balance->amount,
                    'comment' => $comment,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $user_mobile = DB::table('employee')->where('id',$wallet_balance->emp_id)->first();
            if ($user_mobile) {
                $message = urldecode("Your Wallet has been credited by Rs. $amount.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            }  
        }
        return redirect()->back()->with('message','Wallet Balance Credited From Wallet');

    }

    public function walletHistory($emp_id)
    {
        try {
            $emp_id = decrypt($emp_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $wallet = DB::table('employee_wallet')
            ->where('emp_id',$emp_id)
            ->first();
        $wallet_history = DB::table('employee_wallet_history')
            ->where('employee_id',$emp_id)
            ->orderBy('id','desc')
            ->paginate(50);
        return view('admin.employee.employee_wallet_history',compact('wallet','wallet_history'));
    }
}
