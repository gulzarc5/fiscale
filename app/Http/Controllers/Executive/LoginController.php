<?php

namespace App\Http\Controllers\Executive;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('website.executive.login');
    }

    public function executiveLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        if (Auth::guard('executive')->attempt(['email_id' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/executive/deshboard');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }
    public function logout()
    {
        Auth::guard('executive')->logout();
        return redirect()->route('executive.loginForm');
    }
}
