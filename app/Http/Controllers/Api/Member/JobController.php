<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class JobController extends Controller
{
    public function openJobs($member_id,$page)
    {
        $total_job = DB::table('job')
            ->where('job.status','!=',4)
            ->where('job.employee_assignment_status',1)
            ->where('job.assign_to_id',$member_id)
            ->count();
        $total_page = intval(ceil($total_job / 20 ));
        $limit = ($page*20)-20;

        $job = DB::table('job')
            ->select('job.*','client.pan as pan','client.name as c_name','job_type.name as job_type_name','branch.name as branch_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.status','!=',4)
            ->where('job.employee_assignment_status',1)
            ->where('job.assign_to_id',$member_id)
            ->orderBy('job.assigned_date','desc')
            ->skip($limit)
            ->take(20)
            ->get();
        $response = [
            'status' => true,
            'message' => 'Open Job List',
            'total_page' => $total_page,
            'current_page' => $page,
            'data' => $job, 
        ];    	
        return response()->json($response, 200);
    }

    public function rejectJobs($job_id)
    {
        $job = DB::table('job')
            ->where('id',$job_id)
            ->update([
                'employee_assignment_status' => 2,
            ]);
        $response = [
            'status' => true,
            'message' => 'Job Rejected Successfully',
        ];    	
        return response()->json($response, 200);
    }
}
