<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Hash;
use File;
use Response;

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
            ->insertGetId([
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
            DB::table('wallet')
                ->insert([
                    'user_id' => $branch,
                    'amount' => 0,
                    'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                    'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                ]);
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
                $btn ='<a href="'.route('admin.edit_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-warning">Edit</a>';
                if ($row->status == '1') {
                    $btn .='<a href="'.route('admin.update_status_branch',['id'=>encrypt($row->id),'status'=>encrypt(2)]).'" class="btn btn-danger">Deactivate</a>';
                }else{
                    $btn .='<a href="'.route('admin.update_status_branch',['id'=>encrypt($row->id),'status'=>encrypt(1)]).'" class="btn btn-success">Activate</a>';
                }
                $btn .='<a href="'.route('admin.change_pass_branch_form',['id'=>encrypt($row->id)]).'" class="btn btn-danger">Change Password</a>';
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

    public function updateStatusBranch($id, $status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $branch = DB::table('branch')
            ->where('id',$id)
            ->update([
                'status'=>$status,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }

    public function pandingPaymentRequest()
    {
        return view('admin.payment_request.pending_payment_request');
    }

    public function pandingPaymentRequestAjax()
    {
        $query = DB::table('payment_reqest')
            ->select('payment_reqest.*','branch.branch_id as b_branch_id')
            ->leftjoin('branch','branch.id','payment_reqest.branch_id')
            ->where('payment_reqest.status',1)
            ->orderBy('payment_reqest.id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a target="_blank" href="'.route('admin.view_payment_request',['id'=>encrypt($row->id)]).'" class="btn btn-warning">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function viewPaymentRequest($request_id)
    {
        try {
            $request_id = decrypt($request_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $p_rqst = DB::table('payment_reqest')
            ->select('payment_reqest.*','branch.branch_id as b_branch_id')
            ->leftjoin('branch','branch.id','payment_reqest.branch_id')
            ->where('payment_reqest.id',$request_id)
            ->first();

        return view('admin.payment_request.payment_request_view',compact('p_rqst'));
    }

    public function imagePaymentRequest($request_id)
    {
        try {
            $request_id = decrypt($request_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $p_rqst = DB::table('payment_reqest')->where('payment_reqest.id',$request_id)->first();
        if ($p_rqst) {
            $path = storage_path('app\Transaction\\'.$p_rqst->receipt_image);
            if (!File::exists($path)){
                $response = 404;
                return $response;
            } 
            $file = File::get($path);
            $type = File::mimeType($path);
            $response = Response::make($file, 200);
            $response->header("Content-Type", $type);
            return $response;
        }else{
            $response = 404;
            return $response;
        }
    }

    public function processPaymentRequest($request_id,$request_type)
    {
        try {
            $request_id = decrypt($request_id);
            $request_type = decrypt($request_type);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        // Request Type = 1 : accept And Request Type = 2 : reject 

        if ($request_type == '1') {
            $request_fetch = DB::table('payment_reqest')->where('payment_reqest.id',$request_id)->first();

            if ($request_fetch && !empty($request_fetch->branch_id)) {
                $wallet = DB::table('wallet')
                    ->where('branch_id',$request_fetch->branch_id)
                    ->update([
                        'amount' => DB::raw("`amount`+".($request_fetch->amount)),
                    ]);
                $wallet_amount = DB::table('wallet')->where('branch_id',$request_fetch->branch_id)->first();
                if ($wallet && $wallet_amount) {
                    $wallet_history = DB::table('wallet_history')
                    ->where('wallet_id',$wallet_amount->id)
                    ->update([
                        'transaction_type' => 2,
                        'amount' => DB::raw("`amount`+".($request_fetch->amount)),
                    ]);
                }else{
                    return redirect()->back()->with('error','Something Went Wrong Please Try Again');
                }
            }else{
                return redirect()->back()->with('error','Something Went Wrong Please Try Again');
            }
        }else{

        }
    }
}
