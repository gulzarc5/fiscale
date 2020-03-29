<?php

namespace App\Http\Controllers\Api\Sp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;

class JobController extends Controller
{
    public function jobDescList()
    {
        $job_desc_list = DB::table('job_type')->get();
        $response = [
            'status' => true,
            'message' => 'Job Desc List',    
            'data' => $job_desc_list,
        ];    	
        return response()->json($response, 200);
    }
}
