<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class ClassController extends Controller
{
    public function addClassForm()
    {
        return view('admin.configuration.class.add_class_form');
    }

    public function addClass(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'medium' => 'required',
            'fees' => 'required',
        ]);

        $class = DB::table('class')
            ->insert([
                'name' => $request->input('name'),
                'medium' => $request->input('medium'),
                'monthly_fees' => $request->input('fees'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($class) {
            return redirect()->back()->with('message','Class Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function classList()
    {
        $class =  DB::table('class')->whereNull('deleted_at')->get();
        return view('admin.configuration.class.class_list',compact('class'));
    }

    public function classEdit($class_id)
    {
        try {
            $class_id = decrypt($class_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }
        $class =  DB::table('class')->where('id',$class_id)->first();
        return view('admin.configuration.class.edit_class',compact('class'));
    }

    public function classUpdate(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'name' => 'required',
            'medium' => 'required',
            'fees' => 'required',
        ]);

        $class = DB::table('class')
            ->where('id',$request->input('class_id'))
            ->update([
                'name' => $request->input('name'),
                'medium' => $request->input('medium'),
                'monthly_fees' => $request->input('fees'),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($class) {
            return redirect()->back()->with('message','Class Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function classListAjax($medium)
    {
        $class =  DB::table('class')->whereNull('deleted_at')->where('medium',$medium)->get();
        return $class;
    }
}
