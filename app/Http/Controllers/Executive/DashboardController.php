<?php

namespace App\Http\Controllers\Executive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;
use Validator;

class DashboardController extends Controller
{
    public function index()
    {
        $executive_id = Auth::guard('executive')->user()->id;
        $executivge_jobs = DB::table('executive_jobs')
            ->select('executive_jobs.*','job_type.name as job_name','job.job_id as job_id')
            ->leftjoin('job','job.id','=','executive_jobs.job_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('executive_jobs.executive_id',$executive_id )
            ->orderBy('executive_jobs.id','desc')
            ->paginate(50);
        return view('website.executive.home',compact('executivge_jobs'));
    }

    public function jobTransactionSearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->route('executive.deshboard')->withErrors($validator)->withInput();
        }
        $s_date = $request->input('start_date');
        $e_date = $request->input('end_date');
        
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            return redirect()->route('executive.deshboard')->with('error','Please Select End Date Greater Then Start Date');
        }else{
            $executive_id = Auth::guard('executive')->user()->id;
            $s_date = Carbon::parse($s_date)->startOfDay();
            $e_date = Carbon::parse($e_date)->endOfDay();

            $executivge_jobs = DB::table('executive_jobs')
                ->select('executive_jobs.*','job_type.name as job_name','job.job_id as job_id')
                ->leftjoin('job','job.id','=','executive_jobs.job_id')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('executive_jobs.executive_id',$executive_id )
                ->whereBetween('executive_jobs.created_at', [$s_date, $e_date])
                ->orderBy('executive_jobs.id','desc')
                ->paginate(50);
            return view('website.executive.home',compact('executivge_jobs'));
        }
    }
}
