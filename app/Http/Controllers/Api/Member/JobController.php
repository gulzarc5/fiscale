<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Carbon\Carbon;

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

    public function viewJobs($job_id)
    {
        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile','client.gender as gender','client.dob as dob','client.constitution as constitution')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('client','client.id','=','job.client_id')
            ->where('job.job_id',$job_id)
            ->first();
        if ($job) {
            $job->comments = DB::table('job_remarks')->where('job_id',$job->id)->orderBy('id','desc')->get();
            foreach ($job->comments as $key => $value) {
                if ($value->remarks_by =="2") {
                    $emp = DB::table('employee')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $emp->name;
                }elseif ($value->remarks_by =="3") {
                    $branch = DB::table('branch')->where('id',$value->created_by_id)->first();
                    $value->remarks_by_name = $branch->name;
                }else{
                    $value->remarks_by_name = "Admin";
                }
            }
        }
        $response = [
            'status' => true,
            'message' => 'Job Details',
            'data' => $job,
        ];    	
        return response()->json($response, 200);
    }

    public function jobEdit($id)
    {
        $job = DB::table('job')
        ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
        ->leftjoin('job_type','job_type.id','=','job.job_type')
        ->leftjoin('client','client.id','=','job.client_id')
        ->where('job.id',$id)
        ->first();
        $response = [
            'status' => true,
            'message' => 'Job Edit Details',
            'data' => $job,
        ];    	
        return response()->json($response, 200);
    }

    public function jobUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'job_type_id' => 'required',
        ]);
        
        if ($validator->fails()) { 
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];  	
            return response()->json($response, 200);
        }

        $update = DB::table('job')
        ->where('id',$request->input('id'))
            ->update([
                'job_type' => $request->input('job_type_id'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($update) {
            $response = [
                'status' => true,
                'message' => 'Job Updated Successfully',
                'error_code' => false,
                'error_message' => null,
            ];  	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong',
                'error_code' => false,
                'error_message' => null,
            ];  	
            return response()->json($response, 200);
        }
    }
}
