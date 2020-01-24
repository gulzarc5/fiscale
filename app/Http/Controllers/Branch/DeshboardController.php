<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Carbon\Carbon;

class DeshboardController extends Controller
{
    public function index()
    {
        $branch_id = Auth::guard('branch')->user()->id;

        $job = DB::table('job')
        ->select('job.*','client.client_id as c_id','client.name as c_name','job_type.name as job_type_name','employee.name as employee_name')
        ->leftjoin('client','client.id','=','job.client_id')
        ->leftjoin('employee','employee.id','=','job.assign_to_id')
        ->leftjoin('job_type','job_type.id','=','job.job_type')
        ->where('job.status',3)
        ->where('job.created_by_id',$branch_id)
        ->orderBy('job.id','desc')->get();
        return view('website.branch.correction_job_list',compact('job'));
    }

    public function addNewRemark(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'message' => 'required',
        ]);
        $branch_id = Auth::guard('branch')->user()->id;

        $remarks = DB::table('job_remarks')
            ->insert([
                'job_id' => $request->input('job_id'),
                'remarks' => $request->input('message'),
                'remarks_by' => 3,
                'created_by_id' => $branch_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();

    }

    public function addClient()
    {
        $job_type = DB::table('job_type')->get();
        return view('website.branch.branch_home',compact('job_type'));
    }

    public function branchUsers()
    {
        $user_id = Auth::guard('branch')->id();
        $users = DB::table('client')->where('created_by_id',$user_id)->get();
        return view('website.branch.user_list',compact('users'));
    }

    public function branchUserView($user_id)
    {
        try {
            $user_id = decrypt($user_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $user = DB::table('client')->where('id',$user_id)->first();

        $job = DB::table('job')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->select('job.*','job_type.name as job_type_name')
            ->where('client_id',$user_id)->get();

        $page = "1";
        return view('website.branch.branch_tracking_details',compact('user','job','page'));
    }
}
