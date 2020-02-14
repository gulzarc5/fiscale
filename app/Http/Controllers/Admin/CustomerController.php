<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use DataTables;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AdminClientInfo;

class CustomerController extends Controller
{
    public function customerList()
    {
        return view('admin.customer.customer_list');
    }

    public function customerAjaxList()
    {
        $query = DB::table('client')
            ->select('client.*','branch.name as branch_name','branch.branch_id as b_branch_id')
            ->leftjoin('branch','branch.id','=','client.created_by_id')
            ->whereNull('deleted_at')
            ->orderBy('id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.client_edit',['client_id'=>encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank">Edit</a><a href="'.route('admin.client_detail',['client_id'=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function viewClient($client_id)
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
                ->select('job.*','job_type.name as job_type_name')
                ->leftjoin('job_type','job_type.id','=','job.job_type')
                ->where('job.client_id',$client_personal->id)
                ->get();
        }
       return view('admin.customer.client_detail',compact('client_personal','res_addr','business_addr','job_det'));
    }

    public function customerInfoExport($id)
    {
        $client = DB::table('client')->where('id',$id)->first();
        if ($client) {
            return Excel::download(new AdminClientInfo($id), ''.$client->name.'.xlsx');
        }
    }

    public function jobList()
    {
        return view('admin.customer.job_list');
    }

    public function jobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name','branch.branch_id as branch_id','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->where('job.status',1)
            ->where('job.employee_assignment_status',1)
            ->orderBy('job.id','desc');
        $employee = DB::table('employee')->where('status',1)->get();
        $emp_data = '<option value="">Please Select Employee</option>';
        foreach ($employee as $key => $value) {
            $emp_data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('assign_emp', function($row) use($emp_data){
                if (empty($row->assign_to_id)) {
                    $btn ='
                    <a id="btn'.$row->id.'">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Assign Employee</button>
                   </a>
                   <form action="'.route('admin.job_assign').'" method="post">
                   <input name="_token" value="'.csrf_token().'" type="hidden">
                    <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Assign Employee For Job :'.$row->job_id.'</h4>
                                </div>
                                <input type="hidden" name="job_id" value="'.$row->id.'">
                                <div class="modal-body dispatch-order">
                                    <div class="form-group" style="width: 100%;">                   <label>Select Employee</label><br>
                                        <select name="emp_id" class="form-control" style="width: 100%;">'.$emp_data.'</select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>';
                return $btn;
                }else{
                    $btn = $row->employee_name;
                    return $btn;
                }
            })
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.job_edit',[''=>encrypt($row->id)]).'" class="btn btn-warning btn-sm" target="_blank">Edit</a>
                <a href="'.route('admin.job_detail',[''=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                ';
                return $btn;
            })
            ->rawColumns(['action','assign_emp'])
            ->make(true);
    }

    public function viewJob($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $job_det =  DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.id',$job_id)
            ->first();
        $jod_det_id = null;
        $remarks = null;
        if ($job_det) {
            $jod_det_id = $job_det->job_id;
            $remarks = DB::table('job_remarks')->where('job_id',$job_id)->get();
        }
       return view('admin.customer.job_detail',compact('job_det','remarks','jod_det_id'));
    }

    public function editJob($job_id)
    {
        try {
            $job_id = decrypt($job_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $job =  DB::table('job')
            ->select('job.*','job_type.name as job_type_name','client.name as cl_name','client.pan as cl_pan','client.mobile as cl_mobile')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.id',$job_id)
            ->first();
        $job_type = DB::table('job_type')->get();
        return view('admin.customer.job_edit',compact('job','job_type'));
    }

    public function updateJob(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'job_type' => 'required',
        ]);

        $update = DB::table('job')
            ->where('id',$request->input('job_id'))
            ->update([
                'job_type' => $request->input('job_type'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        if ($update) {
            return redirect()->back()->with('message','Job Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
    
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
        return view('admin.customer.client_edit',compact('client','job_type','residential','business'));
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

    public function jobAssign(Request $request)
    {
        $request->validate([
            'job_id' => 'required',
            'emp_id' => 'required',
        ]);

        $job_id = $request->input('job_id');
        $emp_id = $request->input('emp_id');

        DB::table('job')
            ->where('id',$job_id)
            ->update([
                'assign_to_id' => $emp_id,
                'assigned_date' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateString(),
                'status' => 2,
                'employee_assignment_status' => 1,
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return redirect()->back();
    }


    public function workingJobList()
    {
        return view('admin.customer.working_job_list');
    }

    public function workingJobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name','branch.branch_id as branch_id','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->where('job.status',2)
            ->where('job.employee_assignment_status',1)
            ->orderBy('job.id','desc');
        $employee = DB::table('employee')->where('status',1)->get();
        $emp_data = '<option value="">Please Select Employee</option>';
        foreach ($employee as $key => $value) {
            $emp_data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('assign_emp', function($row) use($emp_data){
                if (empty($row->assign_to_id)) {
                    $btn ='
                    <a id="btn'.$row->id.'">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Assign Employee</button>
                   </a>
                   <form action="'.route('admin.job_assign').'" method="post">
                   <input name="_token" value="'.csrf_token().'" type="hidden">
                    <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Assign Employee For Job :'.$row->job_id.'</h4>
                                </div>
                                <input type="hidden" name="job_id" value="'.$row->id.'">
                                <div class="modal-body dispatch-order">
                                    <div class="form-group" style="width: 100%;">                   <label>Select Employee</label><br>
                                        <select name="emp_id" class="form-control" style="width: 100%;">'.$emp_data.'</select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>';
                return $btn;
                }else{
                    $btn = "Assigned";
                    return $btn;
                }
            })
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.job_detail',[''=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                ';
                return $btn;
            })
            ->rawColumns(['action','assign_emp'])
            ->make(true);
    }

    public function problemJobList()
    {
        return view('admin.customer.problem_job_list');
    }

    public function problemJobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name','branch.branch_id as branch_id','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->where('job.status',3)            
            ->where('job.employee_assignment_status',1)
            ->orderBy('job.id','desc');
        $employee = DB::table('employee')->where('status',1)->get();
        $emp_data = '<option value="">Please Select Employee</option>';
        foreach ($employee as $key => $value) {
            $emp_data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('assign_emp', function($row) use($emp_data){
                if (empty($row->assign_to_id)) {
                    $btn ='
                    <a id="btn'.$row->id.'">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Assign Employee</button>
                   </a>
                   <form action="'.route('admin.job_assign').'" method="post">
                   <input name="_token" value="'.csrf_token().'" type="hidden">
                    <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Assign Employee For Job :'.$row->job_id.'</h4>
                                </div>
                                <input type="hidden" name="job_id" value="'.$row->id.'">
                                <div class="modal-body dispatch-order">
                                    <div class="form-group" style="width: 100%;">                   <label>Select Employee</label><br>
                                        <select name="emp_id" class="form-control" style="width: 100%;">'.$emp_data.'</select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>';
                return $btn;
                }else{
                    $btn = "Assigned";
                    return $btn;
                }
            })
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.job_detail',[''=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                ';
                return $btn;
            })
            ->rawColumns(['action','assign_emp'])
            ->make(true);
    }


    public function completedJobList()
    {
        return view('admin.customer.complete_job_list');
    }

    public function completedJobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name','branch.branch_id as branch_id','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->where('job.status',4)            
            ->where('job.employee_assignment_status',1)
            ->orderBy('job.id','desc');
        $employee = DB::table('employee')->where('status',1)->get();
        $emp_data = '<option value="">Please Select Employee</option>';
        foreach ($employee as $key => $value) {
            $emp_data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('assign_emp', function($row) use($emp_data){
                if (empty($row->assign_to_id)) {
                    $btn ='
                    <a id="btn'.$row->id.'">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Assign Employee</button>
                   </a>
                   <form action="'.route('admin.job_assign').'" method="post">
                   <input name="_token" value="'.csrf_token().'" type="hidden">
                    <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Assign Employee For Job :'.$row->job_id.'</h4>
                                </div>
                                <input type="hidden" name="job_id" value="'.$row->id.'">
                                <div class="modal-body dispatch-order">
                                    <div class="form-group" style="width: 100%;">                   <label>Select Employee</label><br>
                                        <select name="emp_id" class="form-control" style="width: 100%;">'.$emp_data.'</select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>';
                return $btn;
                }else{
                    $btn = "Assigned";
                    return $btn;
                }
            })
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.job_detail',[''=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                ';
                return $btn;
            })
            ->rawColumns(['action','assign_emp'])
            ->make(true);
    }

    public function empRejectedJobList()
    {
        return view('admin.customer.rejected_job_list');
    }

    public function empRejectedJobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name','branch.branch_id as branch_id','employee.name as employee_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->where('job.status',2)            
            ->where('job.employee_assignment_status',2)
            ->orderBy('job.id','desc');
        $employee = DB::table('employee')->where('status',1)->get();
        $emp_data = '<option value="">Please Select Employee</option>';
        foreach ($employee as $key => $value) {
            $emp_data .= '<option value="'.$value->id.'">'.$value->name.'</option>';
        }

        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('assign_emp', function($row) use($emp_data){
                    $btn ='
                    <a id="btn'.$row->id.'">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".mod'.$row->id.'">Assign Employee</button>
                   </a>
                   <form action="'.route('admin.job_assign').'" method="post">
                   <input name="_token" value="'.csrf_token().'" type="hidden">
                    <div class="modal fade bs-example-modal-sm mod'.$row->id.'" tabindex="-1" role="dialog" aria-hidden="true" >
                    <div class="modal-dialog modal-sm" style="width:500px">
                        <div class="modal-content">
                            <form>
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                                    </button>
                                    <h4 class="modal-title" id="myModalLabel2">Assign Employee For Job :'.$row->job_id.'</h4>
                                </div>
                                <input type="hidden" name="job_id" value="'.$row->id.'">
                                <div class="modal-body dispatch-order">
                                    <div class="form-group" style="width: 100%;">                   <label>Select Employee</label><br>
                                        <select name="emp_id" class="form-control" style="width: 100%;">'.$emp_data.'</select>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                </form>';
                return $btn;
            })
            ->addColumn('action', function($row){
                $btn ='<a href="'.route('admin.job_detail',[''=>encrypt($row->id)]).'" class="btn btn-info btn-sm" target="_blank">View</a>
                ';
                return $btn;
            })
            ->rawColumns(['action','assign_emp'])
            ->make(true);
    }

    public function updateRemark(Request $request)
    {
        $request->validate([
            'remark' => 'required',
            'rem_id' => 'required',
        ]);
        $remark_update = DB::table('job_remarks')
            ->where('id',$request->input('rem_id'))
            ->update([
                'remarks_by'=>1,
                'remarks' => strval($request->input('remark')),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        return 1;
    }

    public function addRemark(Request $request)
    {
        $request->validate([
            'remark' => 'required',
            'job_id' => 'required',
        ]);
        $remark_update = DB::table('job_remarks')
        ->insert([
            'remarks_by'=>1,
            'job_id' => $request->input('job_id'), 
            'remarks' => $request->input('remark'),
            'created_by_id' => 'A',
            'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
        ]);
        return redirect()->back();
    }
}
