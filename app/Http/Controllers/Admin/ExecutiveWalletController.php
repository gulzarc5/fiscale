<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class ExecutiveWalletController extends Controller
{
    public function executiveJobReportForm()
    {
        $executive = DB::table('executive')->where('status',1)->get();
        return view('admin.wallet_report.executive_job_report',compact('executive'));
    }
}
