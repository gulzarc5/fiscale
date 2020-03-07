<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class ExecutiveController extends Controller
{
    public function addExecutiveForm()
    {
        return view('admin.executive.add_new_executive');
    }

    public function addExecutive(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email_id' => ['required', 'string', 'email', 'max:255', 'unique:executive'],
            'mobile' => 'required',
            'password' => ['required', 'string', 'min:8'],
            'gender' => 'required',
        ]);
        $executive = DB::table('executive')
            ->insertGetId($request->except('_token'));
        if ($executive) {
            DB::table('executive_wallet')
                ->insert([
                    'executive_id'=>$executive,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
        }
        return redirect()->back()->with('message','New Executive Added Successfully');
    }

    public function executiveList()
    {
        $executive = DB::table('executive')->get();
        return view('admin.executive.executive_list',compact('executive'));
    }

    public function editExecutiveForm($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $executive = DB::table('executive')->where('id',$id)->first();
        return view('admin.executive.executive_edit',compact('executive'));
    }

    public function updateExecutive(Request $request)
    {
        $request->validate([
            'id' => 'required|numeric',
            'name' => 'required',
            'mobile' => 'required',
            'gender' => 'required',
        ]);

        DB::table('executive')
            ->where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'mobile' => $request->input('mobile'),
                'gender' => $request->input('gender'),
                'pin' => $request->input('pin'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
            ]);
        return redirect()->back()->with('message','Executive Updated Successfully');
    }

    public function statusUpdateExecutive($id,$status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $executive = DB::table('executive')->where('id',$id)
            ->update([
                'status'=>$status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function executivePassChange($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $executive = DB::table('executive')->where('id',$id)->first();

        return view('admin.executive.change_pass',compact('executive'));
    }

    public function executivePassChangeSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'id' => 'required',
        ]);
        $executive = DB::table('executive')
            ->where('id',$request->input('id'))
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($executive) {
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
}
