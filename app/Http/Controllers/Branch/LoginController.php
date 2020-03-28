<?php

namespace App\Http\Controllers\Branch;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('website.branch.bran_login');
    }

    public function branchLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        // dd(Hash::make($request->input('password')));
        if (Auth::guard('branch')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/branch/deshboard');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }
    public function logout()
    {
        Auth::guard('branch')->logout();
        return redirect()->route('branch.loginForm');
    }
}
