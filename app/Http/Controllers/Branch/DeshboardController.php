<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DeshboardController extends Controller
{
    public function index()
    {
        return view('website.branch.branch_home');
    }
}
