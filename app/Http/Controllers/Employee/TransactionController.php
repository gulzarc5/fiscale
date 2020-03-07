<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function jobTransactionForm()
    {
        $employee_id = Auth::guard('employee')->user()->id;
       
        $job_transaction = DB::table('employee_jobs')
            ->select('employee_jobs.*','job_type.name as job_name','job.job_id as job_id')
            ->leftjoin('job','job.id','=','employee_jobs.job_id')            
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('employee_jobs.employee_id',$employee_id)
            ->where('employee_jobs.status',1)
            ->get();
            // dd($job_transaction);
       return view('website.employee.transaction.jobs_transaction',compact('job_transaction'));
    }

    public function jobTransactionSearch(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);
        $s_date = $request->input('start_date');
        $e_date = $request->input('end_date');
        
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            return redirect()->back()->with('error','Please Select End Date Greater Then Start Date');
        }else{
            $employee_id = Auth::guard('employee')->user()->id;
            $s_date = Carbon::parse($s_date)->startOfDay();
            $e_date = Carbon::parse($e_date)->endOfDay();
            $job_transaction = DB::table('employee_jobs')
                ->select('employee_jobs.*','job_type.name as job_name','job.job_id as job_id')
                ->leftjoin('job','job.id','=','employee_jobs.job_id')            
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('employee_jobs.employee_id',$employee_id)
                ->where('employee_jobs.status',1)
                ->whereBetween('employee_jobs.created_at', [$s_date, $e_date])
                ->get();
            return view('website.employee.transaction.jobs_transaction',compact('job_transaction'));
        }
    }
}
