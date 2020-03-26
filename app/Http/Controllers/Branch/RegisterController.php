<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use auth;
use Illuminate\Contracts\Encryption\DecryptException;
use Validator;;

class RegisterController extends Controller
{
    public function registerUsers(Request $request)
    {
        $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'dob' => ['required'],           
            'pan'  => ['required','unique:client'],
            'mobile' =>  ['required', 'digits:10', 'numeric', 'unique:client'],
            'constitution' => ['required'],
            'gender' => ['required'],
            'mobile' => ['required'],
            'village_addr' => ['required'],
            'po_addr' => ['required'],
            'ps_addr' => ['required'],
            'district_addr' => ['required'],
            'state_addr' => ['required'],
            'pin_addr' => ['required'],
            'flat' => ['required'],
            'village' => ['required'],
            'po' => ['required'],
            'ps' => ['required'],
            'district' => ['required'],
            'state' => ['required'],
            'pin' => ['required'],
        ]);

        $validator = Validator::make($request->all(), [
            'job_type.*' => 'distinct',
        ]);
        
        if ($validator->fails()) { 
            return redirect()
            ->back()->with('error','Job Description Should Be Distinct If You Are Punching More Then One Job')->withInput();
        } 

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
                'created_by_id' => Auth::guard('branch')->user()->id,
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($user) {
            
            $resident_addr = DB::table('address')
                ->insertGetId([
                    'flat_no' =>  $request->input('flat_addr'),
                    'village' =>  $request->input('village_addr'),
                    'po' =>  $request->input('po_addr'),
                    'ps' =>  $request->input('ps_addr'),
                    'area' =>  $request->input('area_addr'),
                    'dist' =>  $request->input('district_addr'),
                    'state' =>  $request->input('state_addr'),
                    'pin' =>  $request->input('pin_addr'),
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $business_addr = DB::table('address')
                ->insertGetId([
                    'flat_no' =>  $request->input('flat'),
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
            $job_type = $request->input('job_type');
            foreach ($job_type as $key => $value) {
                $job_ins = DB::table('job')
                ->insertGetId([
                    'client_id' => $user,
                    'job_type' => $value,
                    'created_by_id' => Auth::guard('branch')->user()->id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
                if ($job_ins) {                    
                    $job_id = Auth::guard('branch')->user()->branch_id;
                    $branch_id = Auth::guard('branch')->user()->id;
                    $branch_job_count = DB::table('job')->where('created_by_id',$branch_id)->count();
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
            $pan = strtoupper($request->input('pan'));

            return redirect()->route('branch.thank_you',['pan'=>encrypt($pan),'client_id'=>encrypt($user)]);
        } else {
            return redirect()->back()->with('error', 'Something Wrong With Registration Please Try Again');
        }
    }

    public function thankYou($pan,$client_id)
    {
        try {
            $pan = decrypt($pan);
            $client_id = decrypt($client_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        return view('website.branch.thankyou',compact('pan','client_id'));
    }

    public function registrationPrint($client_id)
    {
        try {
            $client_id = decrypt($client_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $client_personal = DB::table('client')->where('id',$client_id)->first();
        $res_addr = null;
        $business_addr = null;
        $job_det = null;
        if ($client_personal) {
            $res_addr = DB::table('address')->where('id',$client_personal->residential_addr_id)->first();
            $business_addr = DB::table('address')->where('id',$client_personal->business_addr_id)->first();
            $job_det =  DB::table('job')
                ->select('job.*','job_type.name as job_desc')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('job.client_id',$client_personal->id)
                ->get();
        }
        return view('website.branch.registration_print',compact('client_personal','res_addr','business_addr','job_det'));
    }
}