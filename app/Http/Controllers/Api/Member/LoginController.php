<?php

namespace App\Http\Controllers\Api\Member;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Illuminate\Support\Str;
use Validator;
use App\Employee;

class LoginController extends Controller
{
    public function memberLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);
        
        if ($validator->fails()) { 
            $response = [
                'status' => false,
                'message' => 'Validation Error',
                'data' => null,
                'error_code' => true,
                'error_message' => $validator->errors(),
            ];  	
            return response()->json($response, 200);
        }
        $user_email = $request->input('email');
        $user_pass = $request->input('password');

        $user = Employee::where('email',$user_email)->first();
        if ($user) {
            if(Hash::check($user_pass, $user->password)){ 
                $user_update = Employee::where('id',$user->id)
                    ->update([
                        'api_token' => Str::random(60),
                    ]);

                $user = Employee::where('id',$user->id)->first();
                $response = [
                    'status' => true,
                    'message' => 'User Logged In Successfully',     
                    'data' => $user,
                    'error_code' => false,
                    'error_message' => null,
                ];    	
                return response()->json($response, 200);
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Email or password Wrong',  
                    'data' => null,
                    'error_code' => false,
                    'error_message' => null,
                ];    	
                return response()->json($response, 200);
            }
        }else{
            $response = [
                'status' => false,
                'message' => 'Email or password Wrong',  
                'data' => null,
                'error_code' => false,
                'error_message' => null,
            ];  	
            return response()->json($response, 200);
        }
    }
}