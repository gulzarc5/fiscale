<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;

class BranchController extends Controller
{
    public function addBranchForm()
    {
        return view('admin.branch.add_new_branch');
    }

    public function addBranch(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => ['required', 'string', 'email', 'max:255', 'unique:branch'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $branch = DB::table('branch')
            ->insert([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'password' => Hash::make($request->input('password')),
                'mobile' => $request->input('mobile'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            return redirect()->back()->with('message','Service Point Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function branchList()
    {
        return view('admin.branch.branch_list');
    }

    public function branchListAjax()
    {
        $query = DB::table('branch')->orderBy('id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.edit_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-warning">Edit</a>
                <a href="'.route('admin.change_pass_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-danger">Change Password</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function editBranchForm($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $branch = DB::table('branch')->where('id',$id)->first();
        return view('admin.branch.branch_edit',compact('branch'));

    }

    public function updateBranch(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'id' => 'required',
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        $branch = DB::table('branch')
            ->where('id',$request->input('id'))
            ->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'state' => $request->input('state'),
                'city' => $request->input('city'),
                'address' => $request->input('address'),
                'pin' => $request->input('pin'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            return redirect()->back()->with('message','Service Point Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function branchPassChange($id)
    {
        try {
            $id = decrypt($id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $branch = DB::table('branch')->where('id',$id)->first();

        return view('admin.branch.change_pass',compact('branch'));
    }

    public function branchPassChangeSubmit(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string', 'min:8'],
            'id' => 'required',
        ]);

        $branch = DB::table('branch')
            ->where('id',$request->input('id'))
            ->update([
                'password' => Hash::make($request->input('password')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($branch) {
            return redirect()->back()->with('message','Password Changed Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
}
