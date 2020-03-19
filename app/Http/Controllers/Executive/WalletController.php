<?php

namespace App\Http\Controllers\Executive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class WalletController extends Controller
{
    public function walletHistory()
    {
        $executive_id = Auth::guard('executive')->user()->id;

        $wallet = DB::table('executive_wallet')->where('executive_id',$executive_id)->first();

        $wallet_history = DB::table('executive_wallet_history')
            ->where('executive_id',$executive_id)->orderBy('id','desc')->paginate(20);
        return view('website.executive.executive_wallet',compact('wallet','wallet_history'));
    }
}
