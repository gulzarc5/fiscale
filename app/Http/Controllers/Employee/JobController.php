<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class JobController extends Controller
{
    public function closeJobForm()
    {
        return view('website.employee.closed_jobs');
    }
}
