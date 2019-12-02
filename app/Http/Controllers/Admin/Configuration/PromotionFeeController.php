<?php

namespace App\Http\Controllers\Admin\Configuration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Carbon\Carbon;
use Illuminate\Contracts\Encryption\DecryptException;

class PromotionFeeController extends Controller
{
    public function addFeeForm()
    {
        return view('admin.configuration.promotionFee.add_new_fee_form');
    }

    public function addFee(Request $request)
    {
        
        $request->validate([
            'name' => 'required',
            'medium' => 'required',
            'class' => 'required',
            'fees' => 'required',
        ]);

        $fees = DB::table('admsn_fee_structure')
            ->insert([
                'name' => $request->input('name'),
                'medium' => $request->input('medium'),
                'class_id' => $request->input('class'),
                'fee_type' => 2,
                'amount' => $request->input('fees'),
                'created_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
                'updated_at' => Carbon::now()->setTimezone('Asia/Kolkata')->toDateTimeString(),
            ]);
        
        if ($fees) {
            return redirect()->back()->with('message','Fees Added Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function FeesList()
    {
        $fees = DB::table('admsn_fee_structure')
            ->select('admsn_fee_structure.*','class.name as c_name')
            ->leftjoin('class','class.id','=','admsn_fee_structure.class_id')
            ->whereNull('admsn_fee_structure.deleted_at')
            ->where('admsn_fee_structure.fee_type',2)
            ->orderBy('admsn_fee_structure.id')
            ->get();
        return view('admin.configuration.promotionFee.fee_list',compact('fees'));
    }

    public function searchFees(Request $request)
    {
        $request->validate([
            'medium' => 'required',
            'class' => 'required',
        ]);

        $fees_search = DB::table('admsn_fee_structure')
            ->select('admsn_fee_structure.*','class.name as c_name')
            ->leftjoin('class','class.id','=','admsn_fee_structure.class_id')
            ->whereNull('admsn_fee_structure.deleted_at')
            ->where('admsn_fee_structure.fee_type',2)
            ->where('admsn_fee_structure.medium',$request->input('medium'))
            ->where('admsn_fee_structure.class_id',$request->input('class'))
            ->orderBy('admsn_fee_structure.id')
            ->get();
        $fees_total = DB::table('admsn_fee_structure')
            ->whereNull('admsn_fee_structure.deleted_at')
            ->where('admsn_fee_structure.fee_type',2)
            ->where('admsn_fee_structure.status',1)
            ->where('admsn_fee_structure.medium',$request->input('medium'))
            ->where('admsn_fee_structure.class_id',$request->input('class'))
            ->sum('amount');
        return view('admin.configuration.promotionFee.fee_list',compact('fees_search','fees_total') );
    }

    public function FeeEditForm($fee_id)
    {
        try {
            $fee_id = decrypt($fee_id);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $fees = DB::table('admsn_fee_structure')
            ->where('id',$fee_id)
            ->first();
        $class_list = null;
        if ($fees->medium) {
            $class_list = DB::table('class')
                ->where('medium',$fees->medium)
                ->whereNull('deleted_at')
                ->where('status',1)
                ->get();
        }
        return view('admin.configuration.promotionFee.fee_edit_form',compact('fees','class_list'));
    }

    public function FeeUpdate(Request $request)
    {
        $request->validate([
            'fee_id' => 'required',
            'name' => 'required',
            'medium' => 'required',
            'class' => 'required',
            'fees' => 'required',
        ]);

        $fees = DB::table('admsn_fee_structure')
            ->where('id',$request->input('fee_id'))
            ->update([
                'name' => $request->input('name'),
                'medium' => $request->input('medium'),
                'class_id' => $request->input('class'),
                'amount' => $request->input('fees'),
            ]);
        
        if ($fees) {
            return redirect()->back()->with('message','Fees Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }

    public function FeeStatus($id,$status)
    {
        try {
            $id = decrypt($id);
            $status = decrypt($status);
        }catch(DecryptException $e) {
            return redirect()->back();
        }

        $fees = DB::table('admsn_fee_structure')
            ->where('id',$id)
            ->update([
                'status' => $status,
            ]);
        
        if ($fees) {
            return redirect()->back()->with('message','Status Updated Successfully');
        }else{
            return redirect()->back()->with('error','Something Went Wrong Please Try Again');
        }
    }
}