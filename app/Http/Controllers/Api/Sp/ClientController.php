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
        // foreach ($client as $key => $value) {
        //     if (!empty($value->residential_addr_id)) {
        //         $value->residential_address = DB::table('address')->where('id',$value->residential_addr_id)->first();
        //     }else {
        //         $value->residential_address = null;
        //     }

        //     if (!empty($value->business_addr_id)) {
        //         $value->busniess_address = DB::table('address')->where('id',$value->business_addr_id)->first();
        //     }else {
        //         $value->busniess_address = null;
        //     }            
        // }
        
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

    public function JobDetails($job_id)
    {
        # code...
    }
}
