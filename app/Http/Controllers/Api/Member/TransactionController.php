<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Carbon\Carbon;

class TransactionController extends Controller
{
    public function walletHistory($member_id,$page)
    {
        $total_history = DB::table('employee_wallet_history')->where('employee_id',$member_id)->count();
        $total_page = intval(ceil($total_history / 20 ));
        $limit = ($page*20)-20;

        $wallet = DB::table('employee_wallet')->where('emp_id',$member_id)->first();
        $wallet->wallet_history = DB::table('employee_wallet_history')
            ->where('employee_id',$member_id)
            ->orderBy('id','desc')
            ->skip($limit)
            ->take(20)
            ->get();
        $response = [
            'status' => true,
            'message' => 'Wallet History',
            'total_page' => $total_page,
            'current_page' => $page,
            'data' => $wallet,
        ];    	
        return response()->json($response, 200);
    }

    public function jobSearch($s_date,$e_date,$member_id,$page)
    {
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            $response = [
                'status' => false,
                'message' => 'Please Select End Date Greater Then Start Date',
                'total_page' => 1,
                'current_page' => 1,
                'data' => [],
            ];    	
            return response()->json($response, 200);
        }else{
            $s_date = Carbon::parse($s_date)->startOfDay();
            $e_date = Carbon::parse($e_date)->endOfDay();

            $job_history = DB::table('employee_jobs')
                ->where('employee_id',$member_id)
                ->whereBetween('created_at', [$s_date, $e_date])
                ->count();
            $total_page = intval(ceil($job_history / 20 ));
            $limit = ($page*20)-20;
        
            $job_transaction = DB::table('employee_jobs')
                ->select('employee_jobs.*','job_type.name as job_name','job.job_id as job_id')
                ->leftjoin('job','job.id','=','employee_jobs.job_id')            
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('employee_jobs.employee_id',$member_id)
                ->whereBetween('employee_jobs.created_at', [$s_date, $e_date])
                ->orderby('employee_jobs.id','desc')
                ->skip($limit)
                ->take(20)
                ->get();

            $response = [
                'status' => true,
                'message' => 'Transaction List',
                'total_page' => $total_page,
                'current_page' => $page,
                'data' => $job_transaction,
            ];    	
            return response()->json($response, 200);
        }
    }
}
