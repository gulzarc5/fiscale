<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;
use DataTables;

class CustomerController extends Controller
{
    public function customerList()
    {
        return view('admin.customer.customer_list');
    }

    public function customerAjaxList()
    {
        $query = DB::table('client')
            ->whereNull('deleted_at')
            ->orderBy('id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="#" class="btn btn-info btn-sm" target="_blank">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function jobList()
    {
        return view('admin.customer.job_list');
    }

    public function jobListAjax()
    {
        $query = DB::table('job')
            ->select('job.*','client.id as c_id','client.name as c_name','client.mobile as c_mobile','client.pan as c_pan','job_type.name as job_type_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            
            ->whereNull('deleted_at')
            ->orderBy('id','desc');
        return datatables()->of($query->get())
            ->addIndexColumn()
            ->addColumn('action', function($row){
                $btn ='<a href="#" class="btn btn-info btn-sm" target="_blank">View</a>';
                return $btn;
            })
            ->rawColumns(['action'])
            ->make(true);
    }
}
