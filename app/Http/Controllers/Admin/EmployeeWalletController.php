<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class EmployeeWalletController extends Controller
{
    public function employeeJobReportForm()
    {
        $employee = DB::table('employee')->where('status',1)->get();
        return view('admin.wallet_report.employee_job_report',compact('employee'));
    }

    public function employeeJobReportSearch(Request $request)
    {
        $request->validate([
            'employee_id' => 'required|numeric',
            's_date' => 'required',
            'e_date' => 'required',
            'search_type' => 'required',  
        ]);
        $emp_id = $request->input('employee_id');
        $s_date = $request->input('s_date');
        $e_date = $request->input('e_date');
        $search_type = $request->input('search_type'); // search Type == 1 means [Employee Jobs] else [Employee Transactions]
        if (!empty($search_type) && ($search_type == '1')) {
            $request->validate([
                'job_type' => 'required|numeric',
            ]);
            $job_type =  $request->input('job_type'); // search Type == 1 means [Not Credit] else [Credit]
            $date_from = Carbon::parse($s_date)->startOfDay();
            $date_to = Carbon::parse($e_date)->endOfDay();

            
            $jobs = DB::table('employee_jobs')
                ->select('employee_jobs.*','job.job_id as emp_job_id','job_type.name as job_type_name')
                ->leftjoin('job','job.id','=','employee_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('employee_jobs.employee_id',$emp_id)
                ->where('employee_jobs.status',$job_type)
                ->whereBetween('employee_jobs.created_at', [$date_from,$date_to])
                ->orderBy('employee_jobs.id','desc')
                ->get();
            if ( $job_type == '1') {                
                return view('admin.wallet_report.employee_job_report_list', compact('jobs','emp_id'));
            }else{
                $credited_jobs = $jobs;
                $jobs_amount_total = DB::table('employee_jobs')
                ->select('employee_jobs.*','job.job_id as emp_job_id','job_type.name as job_type_name')
                ->leftjoin('job','job.id','=','employee_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('employee_jobs.employee_id',$emp_id)
                ->where('employee_jobs.status',$job_type)
                ->whereBetween('employee_jobs.created_at', [$date_from,$date_to])
                ->sum('amount');
                return view('admin.wallet_report.employee_job_report_list', compact('credited_jobs','emp_id','jobs_amount_total'));
            }
        }else{
            $wallet_balance = DB::table('employee_wallet')->where('emp_id',$emp_id)->first();
            $wallet_history = DB::table('employee_wallet_history')->where('employee_id',$emp_id)->get();
            return view('admin.wallet_report.employee_job_report_list', compact('wallet_balance','wallet_history'));
        }
    }

    public function employeeJobCommissionCredit(Request $request)
    {
        $request->validate([
            'id'=> 'required',
            'amount' => 'required',
            'emp_id' => 'required',
        ]);

        $employee_jobs_id = $request->input('id'); // array of data
        $amount = $request->input('amount'); //array of data
        $total_sum = 0;
        $emp_id = $request->input('emp_id');
        if (count($employee_jobs_id) > 0) {
            for ($i=0; $i < count($employee_jobs_id) ; $i++) { 
                if (isset($employee_jobs_id[$i]) && !empty($employee_jobs_id[$i]) && isset($amount[$i]) && !empty($amount[$i]) && ($amount[$i] > 0)) {
                    $total_sum+=$amount[$i];
                }
            }
            
            $wallet_update = DB::table('employee_wallet')
                ->where('emp_id',$emp_id)
                ->update([
                    'amount' => DB::raw("`amount`+".($total_sum)),                    
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if ($wallet_update) {
                $wallet_balance = DB::table('employee_wallet')->where('emp_id',$emp_id)->first();
                $wallet_history_insert = DB::table('employee_wallet_history')
                    ->insertGetId([
                        'wallet_id' => $wallet_balance->id,
                        'employee_id' => $emp_id,
                        'transaction_type' => 1,
                        'type' => 1,
                        'amount' => $total_sum,
                        'total_amount' => $wallet_balance->amount,
                        'comment' => 'Job Balance Credited to wallet',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                if ($wallet_history_insert) {
                    for ($i=0; $i < count($employee_jobs_id) ; $i++) { 
                        if (isset($employee_jobs_id[$i]) && !empty($employee_jobs_id[$i]) && isset($amount[$i]) && !empty($amount[$i]) && ($amount[$i] > 0)) {
                            DB::table('employee_jobs')
                                ->where('id',$employee_jobs_id[$i])
                                ->update([
                                    'status' => 2,
                                    'amount' => $amount[$i],
                                    'emp_wallet_history_id' => $wallet_history_insert,
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                ]);
                        }
                    }
                }
            }            
            return redirect()->route('admin.employee_wallet_history',['emp_id'=>encrypt($emp_id)]);
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
}
