<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class EmployeeWalletController extends Controller
{
    public function employeeJobReportForm()
    {
        $employee = DB::table('employee')->where('status',1)->get();
        return view('admin.wallet_report.employee_job_report',compact('employee'));
    }
}
