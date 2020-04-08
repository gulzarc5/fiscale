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

class PaymentReceive implements FromArray,ShouldAutoSize,WithEvents
{
    private $start_date;
    private $end_date;
    public function __construct($start_date,$end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:H2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:H1');
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
        
       
        $date_from = Carbon::parse($this->start_date)->startOfDay();
        $date_to = Carbon::parse($this->end_date)->endOfDay();
        
     
        $job = DB::table('wallet_order')
            ->select('wallet_order.*','branch.email as b_email','branch.name as b_name','branch.branch_id as b_branch_id')
            ->leftjoin('branch','branch.id','=','wallet_order.user_id')
            ->whereBetween('wallet_order.created_at', [$this->start_date,$this->end_date]);
        $job = $job->orderBy('wallet_order.id','desc')->get();
       

        $data [] = ["DAILY RECEIPTS FROM SP"];

        $data[] = ['Sl No','SP Name','SP Id','Email','Date','Transaction Details','Amount','Receipt Status']; 
        $count = 1;
        foreach ($job as $key => $value) { 
            $status = "Fail";  
            if ($value->status == '2') {
                $status = "Success";
            }         
            $data[] = [ $count,$value->b_name,$value->b_branch_id,$value->b_email,$value->created_at,  $value->payment_id,  $value->amount,  $status];
            $count++;
        }
        return $data;
    }
}