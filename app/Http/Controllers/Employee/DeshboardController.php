<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeshboardController extends Controller
{
    public function index()
    {
        return view('website.employee.empl_home');
    }
}
