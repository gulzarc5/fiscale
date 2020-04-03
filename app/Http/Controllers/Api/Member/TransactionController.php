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
}
