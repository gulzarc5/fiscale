<?php

namespace App\Http\Controllers\Api\Executive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;


class TransactionController extends Controller
{
    public function walletHistory($executive_id,$page)
    {
        $total_history = DB::table('executive_wallet')->where('executive_id',$executive_id)->count();
        $total_page = intval(ceil($total_history / 20 ));
        $limit = ($page*20)-20;

        $wallet = DB::table('executive_wallet')->where('executive_id',$executive_id)->first();
        $wallet->wallet_history = DB::table('executive_wallet_history')
            ->where('executive_id',$executive_id)
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

    public function jobSearch($s_date,$e_date,$executive_id,$page)
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

            $job_history = DB::table('executive_jobs')
                ->where('executive_id',$executive_id)
                ->whereBetween('created_at', [$s_date, $e_date])
                ->count();
            $total_page = intval(ceil($job_history / 20 ));
            $limit = ($page*20)-20;
        
            $job_transaction = DB::table('executive_jobs')
                ->select('executive_jobs.*','job_type.name as job_name','job.job_id as job_id')
                ->leftjoin('job','job.id','=','executive_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('executive_jobs.executive_id',$executive_id )
                ->whereBetween('executive_jobs.created_at', [$s_date, $e_date])
                ->orderBy('executive_jobs.id','desc')
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
