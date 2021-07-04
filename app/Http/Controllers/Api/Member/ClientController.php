<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use Carbon\Carbon;
use App\SmsHelper\Sms;

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

    public function addJobRemarks(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'member_id' => 'required',
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
        // Check If Job Status is Completed Or Not
        $job_status = $request->input('status');
        $job_id = $request->input('job_id');
        $member_id = $request->input('member_id');
        if ($job_status == '4') {
            $validator1 = Validator::make($request->all(),[
                'amount' => 'required|numeric',
            ]);

            if ($validator1->fails()) { 
                $response = [
                    'status' => false,
                    'message' => 'Validation Error',
                    'error_code' => true,
                    'error_message' => $validator1->errors(),
        
                ];    	
                return response()->json($response, 200);
            } 

            $deduct_amount = $request->input('amount');
            $job = DB::table('job')->where('id',$job_id)->first();
            $sp_id = $job->created_by_id;

            $check_sp_wallet = DB::table('wallet')->where('user_id',$sp_id)->first();
            if ($check_sp_wallet->amount < $deduct_amount) {
                $response = [
                    'status' => false,
                    'message' => 'Insufficient Balance In Service Point Wallet',
                    'error_code' => false,
                    'error_message' => null,
        
                ];    	
                return response()->json($response, 200); 
            }
            $this->jobAddWallet($job_id,$deduct_amount,$member_id);
        }

        $remarks = DB::table('job_remarks')
            ->insert([
                'job_id' => $request->input('job_id'),
                'remarks' => $request->input('message'),
                'remarks_by' => 2,
                'created_by_id' => $member_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

        $status = $request->input('status');
        if (isset($status) && !empty($status)) {
            $job_status_update = DB::table('job')
            ->where('id',$request->input('job_id'))
            ->update([
                'status'=>$status,
                'completed_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateString(),
            ]);
            if ($status == '4') {
                $job_sms = DB::table('job')->where('id',$request->input('job_id'))->first();
                if ($job_sms) {
                    $client_mobile = DB::table('client')->where('id', $job_sms->client_id)->first();
                    $job_desc_sms = DB::table('job_type')->where('id',$job_sms->job_type)->first();
                    if (!empty($client_mobile->mobile) && $job_desc_sms) {
                        $message = urldecode("$job_desc_sms->name with Job ID $job_sms->job_id is completed.%0aPlease collect the report from the service point.%0aThank you for choosing us.%0aTeam Fiscale");
                        $user_mobile =  $client_mobile->mobile;
                        Sms::SmsSend($user_mobile,$message);
                    } 
                }               
            }elseif ($status == '3') {
                $job_sms = DB::table('job')->where('id',$request->input('job_id'))->first();
                if ($job_sms) {
                    $client_mobile = DB::table('client')->where('id', $job_sms->client_id)->first();
                    $job_desc_sms = DB::table('job_type')->where('id',$job_sms->job_type)->first();
                    if (!empty($client_mobile->mobile) && $job_desc_sms) {
                        $message = urldecode("Please provide proper documents for $job_desc_sms->name with Job ID $job_sms->job_id.%0aThanks.%0aTeam Fiscale");
                        $user_mobile =  $client_mobile->mobile;
                        Sms::SmsSend($user_mobile,$message);
                    } 
                }  
            }
        }
        $response = [
            'status' => true,
            'message' => 'Remarks Added Successfully',
            'error_code' => false,
            'error_message' => null,

        ];    	
        return response()->json($response, 200); 
    }

    
    function jobAddWallet($job_id,$deduct_amount,$employee_id)
    {

        $job = DB::table('job')
            ->select('job.*','job_type.name as job_type_name')
            ->leftjoin('job_type','job_type.id','=','job.job_type')            
            ->where('job.id',$job_id)
            ->first();
        $sp_id = $job->created_by_id;

        $sp_wallet = DB::table('wallet')
            ->where('user_id',$sp_id)
            ->update([
                'amount' => DB::raw("`amount`-".($deduct_amount)),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($sp_wallet) {
            $wallet_amount=DB::table('wallet')->where('user_id',$sp_id)->first();
            $wallet_history = DB::table('wallet_history')
            ->insert([
                'wallet_id' => $wallet_amount->id,
                'transaction_type' => 1,
                'amount' => $deduct_amount,
                'balance' => floatval($wallet_amount->amount),
                'comment' => "$job->job_type_name - $job->job_id",
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $user_mobile = DB::table('branch')->where('id',$sp_id)->first();
            if ($user_mobile) {
                $message = urldecode("Your Wallet has been debited by Rs. $deduct_amount.");
                $user_mobile =  $user_mobile->mobile;
                Sms::SmsSend($user_mobile,$message);
            } 
        }

        $member_job = DB::table('employee_jobs')
            ->insert([
                'employee_id' => $employee_id,
                'job_id' => $job_id,
                'branch_id' => $sp_id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $sp = DB::table('branch')->where('id',$sp_id)->first();

        $executive_jobs = DB::table('executive_jobs')
            ->insert([
                'executive_id' => $sp->executive_id,
                'job_id' => $job_id,
                'branch_id' => $sp_id,                
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        return true;
    }
}