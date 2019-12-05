<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use DB;
use auth;

class RegisterController extends Controller
{
    public function registerUsers(Request $request)
    {
        $request->validate([
	        'name' => ['required', 'string', 'max:255'],
            'dob' => ['required'],           
            'pan'  => ['required'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:client'],
            'mobile' =>  ['required','digits:10','numeric','unique:client'],
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

        $user = DB::table('client')
            ->insertGetId([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'pan' => $request->input('pan'),
                'father_name' => $request->input('father_name'),
                'dob' => $request->input('dob'),
                'gender' => $request->input('gender'),
                'constitution' => $request->input('constitution'),
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
                    'trade_name' => $request->input('trade_name_addr'),
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
                'trade_name' => $request->input('trade_name'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);

            $job = DB::table('job')
                ->insert([
                    'job_type' =>  $request->input('job_type'),
                    'created_by_id' => Auth::guard('branch')->user()->id,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            $update_client = DB::table('client')
                ->where('id',$user)
                ->update([
                    'residential_addr_id' =>  $resident_addr,
                    'business_addr_id' => $business_addr,
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
            return redirect()->back()->with('message','Client Registered Successfully');   
        }else{
            return redirect()->back()->with('error','Something Wrong With Registration Please Try Again');  
        }
    }

    public function thankYou()
    {
        return view('website.branch.thankyou');
    }
}