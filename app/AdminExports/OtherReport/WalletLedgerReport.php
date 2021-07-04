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

class WalletLedgerReport implements FromArray,ShouldAutoSize,WithEvents
{
    private $type;
    public function __construct($type,$s_date,$e_date,$user_id)
    {
        $this->type = $type; // 1 = Member, 2 = SP, 3 = ME,
        $this->s_date = $s_date;
        $this->e_date = $e_date;
        $this->user_id = $user_id;
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
                $event->sheet->getDelegate()->getStyle('A1:F1')->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
        $date_from = Carbon::parse($this->s_date)->startOfDay();
        $date_to = Carbon::parse($this->e_date)->endOfDay();

        if ($this->type == '1') { 
            $user = DB::table('employee')->where('email',$this->user_id)->first();

            $data [] = ["WALLET LEDGER REPORT OF $user->name"];
            $data[] = ['Sl No','Date','Transaction Type','Comment','Amount','Balance'];             

            $wallet = DB::table('employee_wallet_history')
                ->where('employee_id',$user->id)
                ->whereBetween('employee_wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('employee_wallet_history.id','desc')->get();  

            $count = 1;            
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {   
                $status = 'Credit';
                if ($value->transaction_type == '2') {                    
                    $status = 'Debit';
                }
                $data[] = [ $count,$value->created_at,$status,$value->comment,$value->amount,$value->total_amount];
                $count++;
            }
            return $data;
        }else if ($this->type == '2'){

            $user = DB::table('branch')->where('branch_id',$this->user_id)->first();
            $wallet_info = DB::table('wallet')->where('user_id',$user->id)->first();

            $data [] = ["WALLET LEDGER REPORT OF $user->name"];
            $data[] = ['Sl No','Date','Transaction Type','Comment','Amount','Balance'];  

            $wallet = DB::table('wallet_history')
                ->where('wallet_id',$wallet_info->id)
                ->whereBetween('wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('wallet_history.id','desc')->get();     
               
            $count = 1;
            $date = date("Y-m-d");  
            foreach ($wallet as $key => $value) {   
                $status = 'Credit';
                if ($value->transaction_type == '2') {                    
                    $status = 'Debit';
                }
                $data[] = [ $count,$value->created_at,$status,$value->comment,$value->amount,$value->balance];
                $count++;
            }
            return $data;
        }else{
            $user = DB::table('executive')->where('email_id',$this->user_id)->first();

            $data [] = ["WALLET LEDGER REPORT OF $user->name"];
            $data[] = ['Sl No','Date','Transaction Type','Comment','Amount','Balance'];             

            $wallet = DB::table('executive_wallet_history')
                ->where('executive_id',$user->id)
                ->whereBetween('created_at', [$date_from,$date_to])
                ->orderBy('id','desc')->get();  

            $count = 1;            
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {   
                $status = 'Credit';
                if ($value->transaction_type == '2') {                    
                    $status = 'Debit';
                }
                $data[] = [ $count,$value->created_at,$status,$value->comment,$value->amount,$value->total_amount];
                $count++;
            }
            return $data;
        }
    }
}