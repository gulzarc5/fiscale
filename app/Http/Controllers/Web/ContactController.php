<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function coutactSubmit(Request $request)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $subject = $request->input('subject');
        $message = $request->input('message');
        
        DB::table('contact_mail')
        ->insert([
            'name'=>$name,
            'email'=>$email,
            'subject'=>$subject,
            'message'=>$message,
        ]);
    }
}
