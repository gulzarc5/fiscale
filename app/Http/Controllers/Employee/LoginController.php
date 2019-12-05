<?php

namespace App\Http\Controllers\Employee;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('website.employee.emp_login');
    }

    public function employeeLogin(Request $request){
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
        // dd(Hash::make($request->input('password')));
        if (Auth::guard('employee')->attempt(['email' => $request->email, 'password' => $request->password])) {

            return redirect()->intended('/employee/deshboard');
        }
        return back()->withInput($request->only('email', 'remember'))->with('login_error','Username or password incorrect');
    }
    public function logout()
    {
        Auth::guard('employee')->logout();
        return redirect()->route('employee.loginForm');
    }
}
