<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\EmployeeReport;

class JobController extends Controller
{
    public function closeJobForm()
    {
        $emp_id = Auth::guard('employee')->user()->id;

        $job = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','job_type.name as job_type_name','branch.name as branch_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.status',4)
            ->where('job.assign_to_id',$emp_id)
            ->orderBy('job.assigned_date','desc')->get();
        return view('website.employee.closed_jobs',compact('job'));
    }

    public function JobView($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile','client.gender as gender','client.dob as dob','client.constitution as constitution')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('client','client.id','=','job.client_id')
            ->where('job.job_id',$job_id)
            ->first();
        $comments = null;
        if ($job) {
            $comments = DB::table('job_remarks')->where('job_id',$job->id)->get();
            foreach ($comments as $key => $value) {
                if ($value->remarks_by =="2") {
                    $emp = DB::table('employee')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $emp->name;
                }elseif ($value->remarks_by =="3") {
                    $branch = DB::table('branch')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $branch->name;
                }else{
                    $value->remarks_by_name = "Admin";
                }
            }
            
            $job_input_id = $job->id;
        }

        return view('website.employee.job-details',compact('job','comments','job_id','job_input_id'));
    }

    public function addNewRemark(Request $request)
    {
        $request->validate([
            'job_id' => 'required|numeric',
            'message' => 'required',
            'status' => 'required|numeric',
        ]);
        $employee_id = Auth::guard('employee')->user()->id;

        // Check If Job Status is Completed Or Not
        $job_status = $request->input('status');
        $job_id = $request->input('job_id');
        // dd($job_id);
        if ($job_status == '4') {
            $request->validate([
                'amount' => 'required|numeric',
            ]);
            $deduct_amount = $request->input('amount');
            $job = DB::table('job')->where('id',$job_id)->first();
            $sp_id = $job->created_by_id;

            $check_sp_wallet = DB::table('wallet')->where('user_id',$sp_id)->first();
            if ($check_sp_wallet->amount < $deduct_amount) {
                return redirect()->back()->with('error','Insufficient Balance In Service Point Wallet');
            }
            $this->jobAddWallet($job_id,$deduct_amount);
        }

        $remarks = DB::table('job_remarks')
            ->insert([
                'job_id' => $request->input('job_id'),
                'remarks' => $request->input('message'),
                'remarks_by' => 2,
                'created_by_id' => $employee_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $date = $request->input('comp_date');
        $status = $request->input('status');
        if (isset($status) && !empty($status)) {
            $job_status_update = DB::table('job')
            ->where('id',$request->input('job_id'))
            ->update([
                'status'=>$status,
                'completed_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateString(),
            ]);
        }
        return redirect()->back();
    }

    function jobAddWallet($job_id,$deduct_amount)
    {
        $employee_id = Auth::guard('employee')->user()->id;

        $job = DB::table('job')->where('id',$job_id)->first();
        $sp_id = $job->created_by_id;

        $sp_wallet = DB::table('wallet')
            ->where('user_id',$sp_id)
            ->update([
                'amount' => DB::raw("`amount`-".($deduct_amount)),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($sp_wallet) {
            $wallet_amount=DB::table('wallet')->where('user_id',$sp_id)->first();
            $wallet_history = DB::table('wallet_history')
            ->insert([
                'wallet_id' => $wallet_amount->id,
                'transaction_type' => 1,
                'amount' => $deduct_amount,
                'balance' => floatval($wallet_amount->amount),
                'comment' => "Wallet Balance Deducted For Job Of $job->job_id",
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }

        $member_job = DB::table('employee_jobs')
            ->insert([
                'employee_id' => $employee_id,
                'job_id' => $job_id,
                'branch_id' => $sp_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $sp = DB::table('branch')->where('id',$sp_id)->first();

        $executive_jobs = DB::table('executive_jobs')
            ->insert([
                'executive_id' => $sp->executive_id,
                'job_id' => $job_id,
                'branch_id' => $sp_id,                
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        return true;

    }

    public function remarkEdit($remark_id,$job_id,$page=null)
    {
        try {
            $job_input_id = decrypt($job_id);
            $remark_id = decrypt($remark_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $comments = DB::table('job_remarks')->where('id',$remark_id)->first();
        if (!empty($page)) {
            return view('website.employee.remark_edit',compact('comments','job_input_id','page'));
        }else{
            return view('website.employee.remark_edit',compact('comments','job_input_id'));
        }
        
    }

    public function remarkUpdate(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'rem_id' => 'required',
            'message' => 'required',
        ]);
        $employee_id = Auth::guard('employee')->user()->id;
        $job_id = $request->input('job_id');

        $remarks = DB::table('job_remarks')
            ->where('id',$request->input('rem_id'))
            ->update([
                'remarks' => $request->input('message'),
                'created_by_id' => $employee_id,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $page = $request->input('page');
        if (isset($page) && !empty($page)) {
            return redirect()->route('employee.job_search_view_page',['job_id'=>encrypt($job_id)]);
        }else{
            return redirect()->route('employee.job_view',['job_id'=>encrypt($job_id)]);
        }
    }

    public function JobSearchForm()
    {
        return view('website.employee.job_search');
    }

    public function JobSearchView(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
        ]);
       return redirect()->route('employee.job_search_view_page',['job_id'=>encrypt($request->input('job_id'))]);
    }

    public function JobSearchViewPage($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile','client.gender as gender','client.dob as dob','client.constitution as constitution')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('client','client.id','=','job.client_id')
            ->where('job.job_id',$job_id)
            ->first();
        $comments = null;
        if ($job) {
            $comments = DB::table('job_remarks')->where('job_id',$job->id)->get();
            foreach ($comments as $key => $value) {
                if ($value->remarks_by =="2") {
                    $emp = DB::table('employee')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $emp->name;
                }elseif ($value->remarks_by =="3") {
                    $branch = DB::table('branch')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $branch->name;
                }else{
                    $value->remarks_by_name = "Admin";
                }
            }
            
            $job_input_id = $job->id;
        }

        return view('website.employee.job_details_search',compact('job','comments','job_id','job_input_id'));
    }

    public function JobEditForm($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('client','client.id','=','job.client_id')
            ->where('job.id',$job_id)
            ->first();
        $job_type = DB::table('job_type')->get();

        return view('website.employee.job.employee_job_edit',compact('job_id','job','job_type'));
    }

    public function JobUpdate(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'job_type' => 'required',
        ]);

        $update = DB::table('job')
            ->where('id',$request->input('job_id'))
            ->update([
                'job_type' => $request->input('job_type'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($update) {
            $job = DB::table('job')->where('id',$request->input('job_id'))->first();
            return redirect()->route('employee.job_search_view_page',['job_id'=>encrypt($job->job_id)]);
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }

    }
    
    public function employeeReportForm()
    {
        return view('website.employee.report.complete_job_report');
    }

    public function employeeReport(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
            'type' => 'required',
        ]);
        $s_date = $request->input('start_date');
        $e_date = $request->input('end_date');
        $type = $request->input('type');
        
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            return redirect()->back()->with('error','Please Select End Date Greater Then Start Date');
        }else{
            return Excel::download(new EmployeeReport($s_date,$e_date,$type), 'report.xlsx');
        }
    }

    public function rejectJob($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $job = DB::table('job')
            ->where('id',$job_id)
            ->update([
                'employee_assignment_status' => 2,
            ]);
        return redirect()->back();
    }
}
