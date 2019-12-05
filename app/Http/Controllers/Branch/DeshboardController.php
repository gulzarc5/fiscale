<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;

class DeshboardController extends Controller
{
    public function index()
    {
        $job_type = DB::table('job_type')->get();
        return view('website.branch.branch_home',compact('job_type'));
    }
}
