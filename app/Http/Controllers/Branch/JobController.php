<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use auth;
use Illuminate\Contracts\Encryption\DecryptException;

class JobController extends Controller
{
    public function searchClientAddJobForm()
    {
        return view('website.branch.branch_add_job');
    }

    public function addJobForm(Request $request)
    {
        $request->validate([
            'client_serach_id' => 'required',
        ]);

        $search_key = $request->input('client_serach_id');
        
        if (is_numeric($search_key)) {
            $sql_search = DB::table('client')->where('mobile',$search_key);            
        }else{
            $sql_search = DB::table('client')->where('pan',$search_key);
        }
        if ($sql_search->count() > 0) {
            $client = $sql_search->first();
            $job_type = DB::table('job_type')->get();
            return view('website.branch.branch_submit_job',compact('client','job_type'));
        }else{
            return redirect()->back()->with('error','Sorry No Client Found');
        }
    }

    public function addJob(Request $request)
    {
        $request->validate([
            'job_type' => 'required',
            'client_id' => 'required',
        ]);

        $job_type = array_unique($request->input('job_type'));

        foreach ($job_type as $key => $value) {
            $job_ins = DB::table('job')
            ->insertGetId([
                'client_id' => $request->input('client_id'),
                'job_type' => $value,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            if ($job_ins) {
                $length = 5 - intval(strlen((string) $job_ins));
                $job_id = 'FSP0101';
                for ($i=0; $i < $length; $i++) { 
                    $job_id.='0';
                } 
                $job_id = $job_id.$job_ins;
                $update_job = DB::table('job')
                    ->where('id', $job_ins)
                    ->update([
                        'job_id' =>  $job_id,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
        }
        return redirect()->route('branch.job_thank_you',['client_id' => encrypt($request->input('client_id'))]);
    }

    public function trackJobForm()
    {
        return view('website.branch.branch_track');
    }
    public function trackJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
        ]);

        $job_id = $request->input('job_id');

        $sql_search = DB::table('job')->where('job_id',$job_id)->count();            
        if ($sql_search > 0) {
            return redirect()->route('branch.job_view',['job_id'=>encrypt($job_id)]);
        }else{
            return redirect()->back()->with('error','Sorry No Client Found');
        }
    }

    public function JobView($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('client','client.id','=','job.client_id')
            ->where('job.job_id',$job_id)
            ->first();
        $comments = null;
        if ($job) {
            $comments = DB::table('job_remarks')->where('job_id',$job->id)->get();
        }

        return view('website.branch.branch_job_details',compact('job','comments','job_id'));
    }

    public function JobThankYou($client_id)
    {
        try {
            $client_id = decrypt($client_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $date =Carbon::today()->toDateString();
        $jobs = DB::table('job')
            ->select('job.*','job_type.name as job_type_name')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.client_id',$client_id)
            ->whereDate('job.created_at',$date)
            ->get();
        return view('website.branch.job_add_thankyou',compact('jobs'));
    }
}
