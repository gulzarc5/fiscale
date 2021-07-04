<?php

namespace App\Http\Controllers\Api\Sp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function clientRegistration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'created_by_id' => 'required',
            'name' => ['required', 'string', 'max:255'],
            'dob' => ['required'],           
            'pan'  => ['required','unique:client'],
            'mobile' =>  ['required', 'digits:10', 'numeric', 'unique:client'],
            'constitution' => ['required'],
            'gender' => ['required'],
            'village' => ['required'],
            'po' => ['required'],
            'ps' => ['required'],
            'district' => ['required'],
            'state' => ['required'],
            'pin' => ['required'],
            'village_b' => ['required'],
            'po_b' => ['required'],
            'ps_b' => ['required'],
            'district_b' => ['required'],
            'state_b' => ['required'],
            'pin_b' => ['required'],
            'job_type' =>'required',
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

        $validator = Validator::make($request->all(), [
            'job_type.*' => 'distinct',
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

        $created_by = $request->input('created_by_id');
        $user = DB::table('client')
            ->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'pan' => strtoupper($request->input('pan')),
                'father_name' => $request->input('father_name'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'constitution' => $request->input('constitution'),                
                'trade_name' => $request->input('trade_name'),
                'created_by_id' => $created_by,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($user) {
            $resident_addr = DB::table('address')
                ->insertGetId([
                    'flat_no' =>  $request->input('flat_no'),
                    'village' =>  $request->input('village'),
                    'po' =>  $request->input('po'),
                    'ps' =>  $request->input('ps'),
                    'area' =>  $request->input('area'),
                    'dist' =>  $request->input('district'),
                    'state' =>  $request->input('state'),
                    'pin' =>  $request->input('pin'),
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $business_addr = DB::table('address')
                ->insertGetId([
                    'flat_no' =>  $request->input('flat_no_b'),
                    'village' =>  $request->input('village_b'),
                    'po' =>  $request->input('po_b'),
                    'ps' =>  $request->input('ps_b'),
                    'area' =>  $request->input('area_b'),
                    'dist' =>  $request->input('district_b'),
                    'state' =>  $request->input('state_b'),
                    'pin' =>  $request->input('pin_b'),
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
                $job_type = $request->input('job_type');
                foreach ($job_type as $key => $value) {
                    $job_ins = DB::table('job')
                    ->insertGetId([
                        'client_id' => $user,
                        'job_type' => $value,
                        'created_by_id' => $created_by,
                        'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                    if ($job_ins) { 
                        $sp = DB::table('branch')->where('id',$created_by)->first();                   
                        $job_id = $sp->branch_id;
                        $branch_job_count = DB::table('job')->where('created_by_id',$sp->id)->count();
                        $length = 4 - intval(strlen((string) $branch_job_count));
                        for ($i=0; $i < $length; $i++) { 
                            $job_id.='0';
                        } 
                        $job_id = $job_id.$branch_job_count;
                        $update_job = DB::table('job')
                            ->where('id', $job_ins)
                            ->update([
                                'job_id' =>  $job_id,
                                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                            ]);
                    }
                }
                $update_client = DB::table('client')
                    ->where('id', $user)
                    ->update([
                        'residential_addr_id' =>  $resident_addr,
                        'business_addr_id' => $business_addr,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
                $response = [
                    'status' => true,
                    'message' => 'Client Registered Successfully',
                    'error_code' => false,
                    'error_message' =>null,    
                ];    	
                return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Something Went Wrong Please Try Again',
                'error_code' => false,
                'error_message' =>null,    
            ];    	
            return response()->json($response, 200);
        }
    }

    public function clientList($sp_id,$page)
    {
        $total_client = DB::table('client')->where('created_by_id',$sp_id)->count();
        $total_page = intval(ceil($total_client / 20 ));
        $limit = ($page*20)-20;

        $client = DB::table('client')
        ->where('created_by_id',$sp_id)
        ->orderBy('id','desc')
        ->skip($limit)
        ->take(20)
        ->get();        
        $response = [
            'status' => true,
            'message' => 'Client List',
            'total_page' => $total_page,
            'current_page' => $page,
            'data' => $client, 
        ];    	
        return response()->json($response, 200);

    }

    public function clientDetails($client_id)
    {
        $client = DB::table('client')
        ->where('id',$client_id)
        ->first();
        if ($client) {
            if (!empty($client->residential_addr_id)) {
                $client->residential_address = DB::table('address')->where('id',$client->residential_addr_id)->first();
            }else {
                $client->residential_address = null;
            }
    
            if (!empty($client->business_addr_id)) {
                $client->busniess_address = DB::table('address')->where('id',$client->business_addr_id)->first();
            }else {
                $client->busniess_address = null;
            }
        }    
        
        $response = [
            'status' => true,
            'message' => 'Client Details',
            'data' => $client, 
        ];    	
        return response()->json($response, 200);
    }

    public function clientJobs($client_id)
    {
        $client = DB::table('client')
        ->where('id',$client_id)
        ->first();
        if ($client) {
            $client->jobs =  DB::table('job')
                ->select('job.*','job_type.name as job_desc')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('job.client_id',$client->id)
                ->get();
        }

        $response = [
            'status' => true,
            'message' => 'Client Jobs',
            'data' => $client, 
        ];    	
        return response()->json($response, 200);
    }

    public function addJobClientSearch($search_key)
    {
        $search_key = $search_key;
        if (is_numeric($search_key)) {
            $sql_search = DB::table('client')->where('mobile',$search_key);            
        }else{
            $sql_search = DB::table('client')->where('pan',$search_key);
        }

        if ($sql_search->count() > 0) {
            $client = $sql_search->first();
            $response = [
                'status' => true,
                'message' => 'Client Details',
                'data' => $client, 
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Client Found',
                'data' => null, 
            ];    	
            return response()->json($response, 200);
        }
    }

    public function addJobExistingClient(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'job_type.*' => 'distinct',
            'client_id' => 'required',
            'sp_id' => 'required',
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

        $job_type = $request->input('job_type');
        $user = $request->input('client_id');
        $sp_id = $request->input('sp_id');
        foreach ($job_type as $key => $value) {
            $job_ins = DB::table('job')
            ->insertGetId([
                'client_id' => $user,
                'job_type' => $value,
                'created_by_id' => $sp_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
            if ($job_ins) { 
                $sp = DB::table('branch')->where('id',$sp_id)->first();                   
                $job_id = $sp->branch_id;
                $branch_job_count = DB::table('job')->where('created_by_id',$sp->id)->count();
                $length = 4 - intval(strlen((string) $branch_job_count));
                for ($i=0; $i < $length; $i++) { 
                    $job_id.='0';
                } 
                $job_id = $job_id.$branch_job_count;
                $update_job = DB::table('job')
                    ->where('id', $job_ins)
                    ->update([
                        'job_id' =>  $job_id,
                        'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    ]);
            }
        }

        $response = [
            'status' => true,
            'message' => 'Job Added Successfully',
            'error_code' => false,
            'error_message' => null,    
        ];    	
        return response()->json($response, 200);
    }

    public function clientSearch($search_key)
    {
        $search_key = $search_key;
        if (is_numeric($search_key)) {
            $sql_search = DB::table('client')->where('mobile',$search_key);            
        }else{
            $sql_search = DB::table('client')->where('pan',$search_key);
        }
        if ($sql_search->count() > 0) {
            $client = $sql_search->first();
            $client->jobs = DB::table('job')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->select('job.*','job_type.name as job_type_name')
                ->where('client_id',$client->id)->get();
            $response = [
                'status' => true,
                'message' => 'Client Details',
                'data' => $client, 
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Client Found',
                'data' => null, 
            ];    	
            return response()->json($response, 200);
        }
    }

    public function jobSearch($job_id)
    {
        $job = DB::table('job')
        ->select('job.*','job_type.name as job_type_name','client.id as client_id','client.dob as dob','client.constitution as constitution','client.gender as gender','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
        ->leftjoin('job_type','job_type.id','=','job.job_type')
        ->leftjoin('client','client.id','=','job.client_id')
        ->where('job.job_id',$job_id)
        ->first();
        $comments = null;
        if ($job) {
            $job->comments = DB::table('job_remarks')->where('job_id',$job->id)->get();
            foreach ($job->comments as $key => $value) {
                if ($value->remarks_by == '2') {
                    $name = null;
                    if (isset($value->created_by_id) && !empty($value->created_by_id)){                        
                        $data = DB::table('employee')->select('name')->where('id',$value->created_by_id)->first();
                        $name = $data->name;
                    }
                    $value->remarks_by_name = $name;
                } elseif ($value->remarks_by == '3') {
                    $name = null;
                    if (isset($value->created_by_id) && !empty($value->created_by_id)){                        
                        $data = DB::table('branch')->select('name')->where('id',$value->created_by_id)->first();
                        $name = $data->name;
                    }
                    $value->remarks_by_name = $name;
                } else{
                    $value->remarks_by_name = "Admin";
                }                
            }

            $response = [
                'status' => true,
                'message' => 'Job Details',
                'data' => $job, 
            ];    	
            return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'No Job Found',
                'data' => null, 
            ];    	
            return response()->json($response, 200);
        }
    }

    public function openJobs($sp_id,$page)
    {
        $total_client = DB::table('job')
            ->where('job.status','!=',4)
            ->where('job.created_by_id',$sp_id)
            ->count();
        $total_page = intval(ceil($total_client / 20 ));
        $limit = ($page*20)-20;

        $job = DB::table('job')
            ->select('job.*','client.name as c_name','client.pan as pan','job_type.name as job_type_name','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.status','!=',4)
            ->where('job.created_by_id',$sp_id)
            ->orderBy('job.id','desc')
            ->skip($limit)
            ->take(20)
            ->get();
        $response = [
            'status' => true,
            'message' => 'Open Jobs',
            'total_page' => $total_page,
            'current_page' => $page,
            'data' => $job, 
        ];    	
        return response()->json($response, 200);
    }

    public function addJobRemarks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'sp_id' => 'required',
            'job_id' => 'required',
            'message' => 'required',
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

        $remarks = DB::table('job_remarks')
            ->insert([
                'job_id' => $request->input('job_id'),
                'remarks' => $request->input('message'),
                'remarks_by' => 3,
                'created_by_id' => $request->input('sp_id'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $response = [
            'status' => true,
            'message' => 'Remarks Added Successfully',
            'error_code' => false,
            'error_message' => null,

        ];    	
        return response()->json($response, 200);
    }
}
