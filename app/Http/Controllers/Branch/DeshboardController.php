<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Illuminate\Contracts\Encryption\DecryptException;

class DeshboardController extends Controller
{
    public function index()
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
