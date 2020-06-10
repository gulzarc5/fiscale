<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class DeshboardController extends Controller
{
    public function index()
    {
        $total_jobs = DB::table('job')->count();
        $total_sp = DB::table('branch')->count();
        $total_emp = DB::table('employee')->count();
        $total_client = DB::table('client')->count();
        
        $pending_jobs = DB::table('job')->where('status',1)->count();
        $assigned_jobs = DB::table('job')->where('status',2)->where('employee_assignment_status',1)->count();
        $rejected_jobs = DB::table('job')->where('employee_assignment_status',2)->count();
        $working_jobs = DB::table('job')->where('status',2)->count();
        $correction_jobs = DB::table('job')->where('status',3)->count();
        $completed_jobs = DB::table('job')->where('status',4)->count();
        return view('admin.admindeshboard',compact('total_jobs','total_sp','total_emp','total_client','working_jobs','correction_jobs','completed_jobs','pending_jobs','assigned_jobs','rejected_jobs'));
    }
}
