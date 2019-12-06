<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use auth;

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
            DB::table('job')
            ->insert([
                'client_id' => $request->input('client_id'),
                'job_type' => $value,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        }
        return redirect()->route('branch.search_client_add_job')->with('message','New Job Added Successfully');
    }

    public function trackJobForm()
    {
        return view('website.branch.branch_track');
    }
    public function trackJob(Request $request)
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
            $user = $sql_search->first();
            $job = DB::table('job')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->select('job.*','job_type.name as job_type_name')
                ->where('client_id',$user->id)->get();
            return view('website.branch.branch_tracking_details',compact('user','job'));
        }else{
            return redirect()->back()->with('error','Sorry No Client Found');
        }
    }
}
