<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function clientSearch($search_key)
    {        
        if (is_numeric($search_key)) {
            $sql_search = DB::table('client')->where('mobile',$search_key);            
        }else{
            $sql_search = DB::table('client')->where('pan',$search_key);
        }
        if ($sql_search->count() > 0) {
            $user = $sql_search->first();
            $user->jobs = DB::table('job')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->select('job.*','job_type.name as job_type_name')
                ->where('client_id',$user->id)->get();
                $response = [
                    'status' => true,
                    'message' => 'Client Details',
                    'data' => $user, 
                ];    	
                return response()->json($response, 200);
        }else{
            $response = [
                'status' => false,
                'message' => 'Client Details',
                'data' => null, 
            ];    	
            return response()->json($response, 200);
        }
    }

    public function clientEdit($id)
    {
        $client =  DB::table('client')->where('id',$id)->first();
        $client->residential  = null;
        $client->business  = null;
        if ($client && !empty($client->residential_addr_id)) {
            $client->residential = DB::table('address')->where('id',$client->residential_addr_id)->first();
            $client->business = DB::table('address')->where('id',$client->business_addr_id)->first();
        }
        $response = [
            'status' => true,
            'message' => 'Client Edit Details',
            'data' => $client, 
        ];    	
        return response()->json($response, 200);
    }

    public function clientUpdate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'pan' => 'required',
            'constitution' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'village_r' => 'required',
            'po_r' => 'required',
            'ps_r' => 'required',
            'district_r' => 'required',
            'state_r' => 'required',
            'pin_r' => 'required',
            'village_b' => 'required',
            'po_b' => 'required',
            'ps_b' => 'required',
            'district_b' => 'required',
            'state_b' => 'required',
            'pin_b' => 'required',
            'res_addr_id' => 'required',
            'business_addr_id' => 'required',
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

        $client_update = DB::table('client')
            ->where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'pan' => strtoupper($request->input('pan')),
                'father_name' => $request->input('father_name'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'constitution' => $request->input('constitution'),                
                'trade_name' => $request->input('trade_name'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        $resident_addr = DB::table('address')
            ->where('id', $request->input('res_addr_id'))
            ->update([
                'flat_no' =>  $request->input('flat_r'),
                'village' =>  $request->input('village_r'),
                'po' =>  $request->input('po_r'),
                'ps' =>  $request->input('ps_r'),
                'area' =>  $request->input('area_r'),
                'dist' =>  $request->input('district_r'),
                'state' =>  $request->input('state_r'),
                'pin' =>  $request->input('pin_r'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $business_addr = DB::table('address')
            ->where('id', $request->input('business_addr_id'))
            ->update([
                'flat_no' =>  $request->input('flat_b'),
                'village' =>  $request->input('village_b'),
                'po' =>  $request->input('po_b'),
                'ps' =>  $request->input('ps_b'),
                'area' =>  $request->input('area_b'),
                'dist' =>  $request->input('district_b'),
                'state' =>  $request->input('state_b'),
                'pin' =>  $request->input('pin_b'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $response = [
            'status' => true,
            'message' => 'Client Details Updated Successfully',
            'error_code' => false,
            'error_message' => null,
        ];  	
        return response()->json($response, 200);
    }
}