<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;

class ContactController extends Controller
{
    public function contactMail()
    {
        $contacts = DB::table('contact_mail')->orderBy('id','desc')->get();
        return view('admin.contact.contact_mail',compact('contacts'));
    }
}
