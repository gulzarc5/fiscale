<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Carbon\Carbon;

class DeshboardController extends Controller
{
    public function index()
    {
        $emp_id = Auth::guard('employee')->user()->id;

        $job = DB::table('job')
        ->select('job.*','client.client_id as c_id','client.name as c_name','job_type.name as job_type_name','branch.name as branch_name')
        ->leftjoin('client','client.id','=','job.client_id')
        ->leftjoin('branch','branch.id','=','job.created_by_id')
        ->leftjoin('job_type','job_type.id','=','job.job_type')
        ->where('job.status','!=',4)
        ->where('job.assign_to_id',$emp_id)
        ->orderBy('job.assigned_date','desc')->get();
        return view('website.employee.empl_home',compact('job'));
    }
}
