<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use App\SmsHelper\Sms;

class ExecutiveWalletController extends Controller
{
    public function executiveJobReportForm()
    {
        $executive = DB::table('executive')->where('status',1)->get();
        return view('admin.wallet_report.executive_job_report',compact('executive'));
    }

    public function executiveJobReportSearch(Request $request)
    {
        
        $request->validate([
            'exe_id' => 'required|numeric',
            's_date' => 'required',
            'e_date' => 'required',
            'search_type' => 'required',  
        ]);

   
        $exe_id = $request->input('exe_id');
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
            
            $jobs = DB::table('executive_jobs')
                ->select('executive_jobs.*','job.job_id as emp_job_id','job_type.name as job_type_name')
                ->leftjoin('job','job.id','=','executive_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('executive_jobs.executive_id',$exe_id)
                ->where('executive_jobs.status',$job_type)
                ->whereBetween('executive_jobs.created_at', [$date_from,$date_to])
                ->orderBy('executive_jobs.id','desc')
                ->get();
            if ( $job_type == '1') {                
                return view('admin.wallet_report.executive_job_report_list', compact('jobs','exe_id'));
            }else{
                $credited_jobs = $jobs;
                $jobs_amount_total = DB::table('executive_jobs')
                ->select('executive_jobs.*','job.job_id as emp_job_id','job_type.name as job_type_name')
                ->leftjoin('job','job.id','=','executive_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('executive_jobs.executive_id',$exe_id)
                ->where('executive_jobs.status',$job_type)
                ->whereBetween('executive_jobs.created_at', [$date_from,$date_to])
                ->sum('amount');
                return view('admin.wallet_report.executive_job_report_list', compact('credited_jobs','exe_id','jobs_amount_total'));
            }
        }else{
            $wallet_balance = DB::table('executive_wallet')->where('executive_id',$exe_id)->first();
            $wallet_history = DB::table('executive_wallet_history')->where('executive_id',$exe_id)->get();
            return view('admin.wallet_report.executive_job_report_list', compact('wallet_balance','wallet_history'));
        }
    }

    public function executiveJobCommissionCredit(Request $request)
    {
        $request->validate([
            'id'=> 'required',
            'amount' => 'required',
            'exe_id' => 'required',
        ]);

        $exe_jobs_id = $request->input('id'); // array of data
        $amount = $request->input('amount'); //array of data
        $total_sum = 0;
        $exe_id = $request->input('exe_id');
        if (count($exe_jobs_id) > 0) {
            for ($i=0; $i < count($exe_jobs_id) ; $i++) { 
                if (isset($exe_jobs_id[$i]) && !empty($exe_jobs_id[$i]) && isset($amount[$i]) && !empty($amount[$i]) && ($amount[$i] > 0)) {
                    $total_sum+=$amount[$i];
                }
            }
            
            $wallet_update = DB::table('executive_wallet')
                ->where('executive_id',$exe_id)
                ->update([
                    'amount' => DB::raw("`amount`+".($total_sum)),                    
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            if ($wallet_update) {
                $wallet_balance = DB::table('executive_wallet')->where('executive_id',$exe_id)->first();
                $wallet_history_insert = DB::table('executive_wallet_history')
                    ->insertGetId([
                        'wallet_id' => $wallet_balance->id,
                        'executive_id' => $exe_id,
                        'transaction_type' => 1,
                        'type' => 1,
                        'amount' => $total_sum,
                        'total_amount' => $wallet_balance->amount,
                        'comment' => 'Job Balance Credited to wallet',
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                $user_mobile = DB::table('executive')->where('id', $exe_id)->first();
                if ($user_mobile) {
                    $message = urldecode("Your Wallet has been credited by Rs. $total_sum");
                    $user_mobile =  $user_mobile->mobile;
                    Sms::SmsSend($user_mobile,$message);
                }  
                if ($wallet_history_insert) {
                    for ($i=0; $i < count($exe_jobs_id) ; $i++) { 
                        if (isset($exe_jobs_id[$i]) && !empty($exe_jobs_id[$i]) && isset($amount[$i]) && !empty($amount[$i]) && ($amount[$i] > 0)) {
                            DB::table('executive_jobs')
                                ->where('id',$exe_jobs_id[$i])
                                ->update([
                                    'status' => 2,
                                    'amount' => $amount[$i],
                                    'exe_wallet_history_id' => $wallet_history_insert,
                                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                                ]);
                        }
                    }
                }
            }         
            return redirect()->route('admin.executive_job_report_form')->with('message','balance Credited To Wallet');
            // return redirect()->route('admin.employee_wallet_history',['emp_id'=>encrypt($emp_id)]);
        }else{
            return redirect()->route('admin.executive_job_report_form')->with('error','Something Went Wrong Please Try Again');
        }
    }
}
