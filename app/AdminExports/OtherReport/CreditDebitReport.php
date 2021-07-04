<?php
namespace App\AdminExports\OtherReport;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
use Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;

class CreditDebitReport implements FromArray,ShouldAutoSize,WithEvents
{
    private $type;
    public function __construct($type,$trans_type,$s_date,$e_date)
    {
        $this->type = $type; // 1 = Member, 2 = SP, 3 = ME,
        $this->s_date = $s_date;
        $this->e_date = $e_date;
        $this->trans_type = $trans_type; // 1 = Credit, 2 = Debit,
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:G2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:G1');
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 15,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle('A1:H1')->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
        $date_from = Carbon::parse($this->s_date)->startOfDay();
        $date_to = Carbon::parse($this->e_date)->endOfDay();

        if ($this->type == '1') {            

            if ($this->trans_type == '1') {
                $data [] = ["MEMBER AMOUNT CREDIT REPORT"];
                $data[] = ['Sl No','Date','Comment','Member Name','Mobile No','Amount','Balance']; 

                 $wallet = DB::table('employee_wallet_history')
                ->select('employee_wallet_history.*','employee.name as name','employee.mobile as mobile')
                ->leftjoin('employee','employee.id','=','employee_wallet_history.employee_id')
                ->where('employee_wallet_history.transaction_type',1)
                ->whereBetween('employee_wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('employee_wallet_history.id','desc')->get();
            } else {
                $data [] = ["MEMBER AMOUNT DEBIT REPORT"];
                $data[] = ['Sl No','Date','Comment','Member Name','Mobile No','Amount','Balance']; 
                 $wallet = DB::table('employee_wallet_history')
                ->select('employee_wallet_history.*','employee.name as name','employee.mobile as mobile')
                ->leftjoin('employee','employee.id','=','employee_wallet_history.employee_id')
                ->where('employee_wallet_history.transaction_type',2)
                ->whereBetween('employee_wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('employee_wallet_history.id','desc')->get();
            }     
           
            $count = 1;            
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {   
                $data[] = [ $count,$value->created_at,$value->comment,$value->name,$value->mobile,$value->amount,$value->total_amount];
                $count++;
            }
            return $data;
        }else if ($this->type == '2'){

            if ($this->trans_type == '1') {
                $data [] = ["SP AMOUNT CREDIT REPORT"];
                $data[] = ['Sl No','Date','Comment','SP Name','SP ID','Amount','Balance'];                
                $wallet = DB::table('wallet_history')
                ->select('wallet_history.*','branch.name as name','branch.branch_id as sp_id')
                ->leftjoin('wallet','wallet.id','=','wallet_history.wallet_id')
                ->leftjoin('branch','branch.id','=','wallet.user_id')
                ->where('wallet_history.transaction_type',2)
                ->whereBetween('wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('wallet_history.id','desc')->get();     
            } else {
                $data [] = ["SP AMOUNT DEBIT REPORT"];
                $data[] = ['Sl No','Date','Comment','SP Name','SP ID','Amount','Balance'];
                 $wallet = DB::table('wallet_history')
                ->select('wallet_history.*','branch.name as name','branch.branch_id as sp_id')
                ->leftjoin('wallet','wallet.id','=','wallet_history.wallet_id')
                ->leftjoin('branch','branch.id','=','wallet.user_id')
                ->where('wallet_history.transaction_type',1)
                ->whereBetween('wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('wallet_history.id','desc')->get();
            }     
            $count = 1;
            $date = date("Y-m-d");  
            foreach ($wallet as $key => $value) {   
                $data[] = [ $count,$value->created_at,$value->comment,$value->name,$value->sp_id,$value->amount,$value->balance ];
                $count++;
            }
            return $data;
        }else{

            if ($this->trans_type == '1') { 
                $data [] = ["ME AMOUNT CREDIT REPORT"];
                $data[] = ['Sl No','Date','Comment','ME Name','Mobile No','Amount','Balance'];  

                $wallet = DB::table('executive_wallet_history')
                ->select('executive_wallet_history.*','executive.name as name','executive.mobile as mobile')
                ->leftjoin('executive','executive.id','=','executive_wallet_history.executive_id')
                ->where('executive_wallet_history.transaction_type',1)
                ->whereBetween('executive_wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('executive_wallet_history.id','desc')->get();     
            } else {
                 $data [] = ["ME AMOUNT DEBIT REPORT"];
                $data[] = ['Sl No','Date','Comment','ME Name','Mobile No','Amount','Balance'];
            
                 $wallet = DB::table('executive_wallet_history')
                ->select('executive_wallet_history.*','executive.name as name','executive.mobile as mobile')
                ->leftjoin('executive','executive.id','=','executive_wallet_history.executive_id')
                ->where('executive_wallet_history.transaction_type',2)
                ->whereBetween('executive_wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('executive_wallet_history.id','desc')->get();
            }
            $count = 1;
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {     
                $data[] = [ $count,$value->created_at,$value->comment,$value->name,$value->mobile,$value->amount,$value->total_amount];
                $count++;
            }
            return $data;
        }
    }
}