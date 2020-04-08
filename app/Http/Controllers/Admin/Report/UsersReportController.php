<?php

namespace App\Http\Controllers\Admin\Report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\AdminExports\MemberList;
use App\AdminExports\MarketingExecutiveList;
use App\AdminExports\SpList;
use App\AdminExports\JobReport;
use Carbon\Carbon;
use App\SmsHelper\Sms;

use App\AdminExports\OtherReport\PaymentReceive;
use App\AdminExports\OtherReport\WalletBalance;

class UsersReportController extends Controller
{
    public function usersReportForm()
    {
        return view('admin.report.users_report');
    }

    public function memberList()
    {
        return Excel::download(new MemberList(), 'member_list.xlsx');
    }

    public function executiveList()
    {
        return Excel::download(new MarketingExecutiveList(), 'me_list.xlsx');
    }

    public function spList()
    {
        return Excel::download(new SpList(), 'sp_list.xlsx');
    }

    public function jobReportForm()
    {
        return view('admin.report.job_report');
    }

    public function jobSearchExport(Request $request)
    {
        $request->validate([
            's_date' => 'required',
            'e_date' => 'required',
            'search_type' => 'required',
        ]);
        $s_date = $request->input('s_date');
        $e_date = $request->input('e_date');
        $type = $request->input('search_type'); // 1 = pending, 2 = Completed, 3 = Correction, 4 = Assigned, 5 = Rejected
        
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            return redirect()->back()->with('error','Please Select End Date Greater Then Start Date');
        }else{
            if ( $type == '1') {
                $name = "pending_job_report.xlsx";
            }else if ( $type == '2') {
                $name = "completed_job_report.xlsx";
            }else if ( $type == '3') {
                $name = "correction_job_report.xlsx";
            }else if ( $type == '4') {
                $name = "assigned_job_report.xlsx";
            }else if ( $type == '5') {
                $name = "rejected_job_report.xlsx";
            }
            return Excel::download(new JobReport($s_date,$e_date,$type), $name);
        }
    }

    public function otherReportForm()
    {
        return view('admin.report.other_report');
    }

    public function paymentReceiveReportSearch()
    {
        return view('admin.report.payment_receive_search');
    }

    public function paymentReceiveReportSearchExport(Request $request)
    {
        $request->validate([
            's_date' => 'required',
            'e_date' => 'required',
        ]);
        $s_date = $request->input('s_date');
        $e_date = $request->input('e_date');
        if (Carbon::parse($s_date)->gt(Carbon::parse(Carbon::parse($e_date)))){
            return redirect()->back()->with('error','Please Select End Date Greater Then Start Date');
        }else{
            $name = "payment_receive_report.xlsx";
            return Excel::download(new PaymentReceive($s_date,$e_date), $name);
        }
    }

    public function walletBalanceReportForm()
    {
        return view('admin.report.wallet_balance_report');
    }

    public function walletBalanceReportExport(Request $request)
    {
        $request->validate([
            'type' => 'required',
        ]);
        $type = $request->input('type');
        if ($type == '1') {            
            $name = "member_wallet_report.xlsx";
        } else if ($type == '2'){           
            $name = "sp_wallet_report.xlsx";
        }else{
            $name = "me_wallet_report.xlsx";
        }
        return Excel::download(new WalletBalance($type), $name);
    }
}
