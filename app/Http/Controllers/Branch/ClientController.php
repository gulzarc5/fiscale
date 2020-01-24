<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Auth;
use Carbon\Carbon;

class ClientController extends Controller
{
    public function clientEdit($client_id)
    {
        try {
            $client_id = decrypt($client_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $client =  DB::table('client')->where('id',$client_id)->first();
        $residential  = null;
        $business  = null;
        if ($client && !empty($client->residential_addr_id)) {
            $residential = DB::table('address')->where('id',$client->residential_addr_id)->first();
            $business = DB::table('address')->where('id',$client->business_addr_id)->first();
        }
        return view('website.branch.client.client_edit_form',compact('client','job_type','residential','business'));
    }

    public function ClientUpdate(Request $request)
    {
        $request->validate([
            'client_id' => 'required',
            'name' => 'required',
            'dob' => 'required',
            'pan' => 'required',
            'constitution' => 'required',
            'gender' => 'required',
            'mobile' => 'required',
            'village_addr' => 'required',
            'po_addr' => 'required',
            'ps_addr' => 'required',
            'district_addr' => 'required',
            'state_addr' => 'required',
            'pin_addr' => 'required',
            'village' => 'required',
            'po' => 'required',
            'ps' => 'required',
            'district' => 'required',
            'state' => 'required',
            'pin' => 'required',
            'res_addr_id' => 'required',
            'business_addr_id' => 'required',
        ]);

        $user_update = DB::table('client')
            ->where('id',$request->input('client_id'))
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
                'flat_no' =>  $request->input('flat_addr'),
                'village' =>  $request->input('village_addr'),
                'po' =>  $request->input('po_addr'),
                'ps' =>  $request->input('ps_addr'),
                'area' =>  $request->input('area_addr'),
                'dist' =>  $request->input('district_addr'),
                'state' =>  $request->input('state_addr'),
                'pin' =>  $request->input('pin_addr'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        $business_addr = DB::table('address')
            ->where('id', $request->input('business_addr_id'))
            ->update([
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
        return redirect()->back();        
    }

    public function ClientSearchForm()
    {
        return view('website.branch.client.client_search');
    }

    public function ClientSearch(Request $request)
    {
        $request->validate([
            'client_serach_id' => 'required',
        ]);

        $search_key = $request->input('client_serach_id');
        
        if (is_numeric($search_key)) {
            $sql_search = DB::table('client')->where('mobile',$search_key);            
        }else{
            $sql_search = DB::table('client')->where('pan',$search_key);
        }
        if ($sql_search->count() > 0) {
            $client = $sql_search->first();
            return redirect()->route('branch.client_edit',['client_id'=>encrypt($client->id)]);
        }else{
            return redirect()->back()->with('error','Sorry No Client Found');
        }
    }
}
