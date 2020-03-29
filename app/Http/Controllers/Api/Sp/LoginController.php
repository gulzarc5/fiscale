<?php

namespace App\Http\Controllers\Api\Sp;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;
use Illuminate\Support\Str;
use Validator;
use App\Branch;

class LoginController extends Controller
{
    public function spLogin(Request $request)
    {
        $user_email = $request->input('email');
        $user_pass = $request->input('password');
        
        if (!empty($user_email) && !empty($user_pass)) {
            $user = Branch::where('email',$user_email)->first();
            if ($user) {
                if(Hash::check($user_pass, $user->password)){ 
                    $user_update = Branch::where('id',$user->id)
                        ->update([
                            'api_token' => Str::random(60),
                        ]);
    
                    $user = Branch::where('id',$user->id)->first();
                    $response = [
                        'status' => true,
                        'message' => 'User Logged In Successfully',    
                        'data' => $user,
                    ];    	
                    return response()->json($response, 200);
                }else{
                    $response = [
                        'status' => false,
                        'message' => 'Email or password Wrong',   
                        'data' => null,
                    ];    	
                    return response()->json($response, 200);
                }
            }else{
                $response = [
                    'status' => false,
                    'message' => 'Email or password Wrong',  
                    'data' => null,  
                ];    	
                return response()->json($response, 200);
            }
        }else{
            $response = [
                'status' => false,
                'message' => 'Required Field Can Not be Empty',  
                'data' => null,  
            ];    	
            return response()->json($response, 200);
        }
       
       
    }
}
