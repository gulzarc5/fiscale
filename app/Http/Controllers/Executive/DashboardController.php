<?php

namespace App\Http\Controllers\Executive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        $wallet = DB::table('executive_jobs')
            ->select('executive_jobs.*','job.job_id as job_id')
            ->leftjoin('job','job.id','=','executive_jobs.job_id')
            ->where('executive_jobs.status',2)
            ->orderBy('executive_jobs.id','desc')
            ->get();
        return view('website.executive.home',compact('wallet'));
    }
}
