<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class DeshboardController extends Controller
{
    public function index()
    {
        return view('admin.admindeshboard');
    }
}
