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

class WalletBalance implements FromArray,ShouldAutoSize,WithEvents
{
    private $type;
    public function __construct($type)
    {
        $this->type = $type;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:F2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:F1');
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
        if ($this->type == '1') {
            $data [] = ["MEMBER WALLET BALANCE REPORT"];
            $data[] = ['Sl No','Date','Member Name','Mobile No','Email','Balance']; 

            $wallet = DB::table('employee_wallet')
                ->select('employee_wallet.*','employee.name as name','employee.mobile as mobile','employee.email as email')
                ->leftjoin('employee','employee.id','=','employee_wallet.emp_id')
                ->orderBy('employee_wallet.id','desc')->get();
            $count = 1;            
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {   
                $data[] = [ $count,$date,$value->name,$value->mobile,$value->email,$value->amount];
                $count++;
            }
            return $data;
        } else if ($this->type == '2'){
            $data [] = ["SP WALLET BALANCE REPORT"];
            $data[] = ['Sl No','Date','SP Name','SP ID','Email','Balance'];

            $wallet = DB::table('wallet')
                ->select('wallet.*','branch.name as name','branch.branch_id as b_branch_id','branch.email as email')
                ->leftjoin('branch','branch.id','=','wallet.user_id')
                ->orderBy('wallet.id','desc')->get();
            $count = 1;
            $date = date("Y-m-d");  
            foreach ($wallet as $key => $value) {   
                $data[] = [ $count,$date,$value->name,$value->b_branch_id,$value->email,$value->amount];
                $count++;
            }
            return $data;
        }else{
            $data [] = ["ME WALLET BALANCE REPORT"];
            $data[] = ['Sl No','Date','ME Name','Mobile No','Email','Balance']; 

            $wallet = DB::table('executive_wallet')
                ->select('executive_wallet.*','executive.name as name','executive.mobile as mobile','executive.email_id as email')
                ->leftjoin('executive','executive.id','=','executive_wallet.executive_id')
                ->orderBy('executive_wallet.id','desc')->get();
            $count = 1;
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {     
                $data[] = [ $count,$date,$value->name,$value->mobile,$value->email,$value->amount];
                $count++;
            }
            return $data;
        }
    }
}