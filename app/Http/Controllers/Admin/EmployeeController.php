<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

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
}
