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

class JobTransactionReport implements FromArray,ShouldAutoSize,WithEvents
{
    private $type;
    public function __construct($type,$s_date,$e_date)
    {
        $this->type = $type; // 1 = Member, 2 = SP, 3 = ME,
        $this->s_date = $s_date;
        $this->e_date = $e_date;
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
        $date_from = Carbon::parse($this->s_date)->startOfDay();
        $date_to = Carbon::parse($this->e_date)->endOfDay();

        if ($this->type == '1') { 

            $data [] = ["MEMBER JOB AMOUNT CREDIT REPORT"];
            $data[] = ['Sl No','Date','Job ID/Remarks','Member Name','Mobile No','Amount','Status']; 

            $job = DB::table('employee_jobs')
            ->select('employee_jobs.*','employee.name as name','employee.mobile as mobile','job.job_id as job_id')
            ->leftjoin('employee','employee.id','=','employee_jobs.employee_id')
            ->leftjoin('job','job.id','=','employee_jobs.job_id')
            ->whereBetween('employee_jobs.created_at', [$date_from,$date_to])
            ->orderBy('employee_jobs.id','desc')->get();
             
           
            $count = 1;            
            $date = date("Y-m-d"); 
            foreach ($job as $key => $value) {   
                $status = 'Waiting to credit';
                if ($value->status == '2') {                    
                    $status = 'credited to wallet';
                }
                $data[] = [ $count,$value->created_at,$value->job_id,$value->name,$value->mobile,$value->amount,$status];
                $count++;
            }
            return $data;
        }else if ($this->type == '2'){

                $data [] = ["SP JOB AMOUNT CREDIT REPORT"];
                $data[] = ['Sl No','Date','Job Id/Remarks','SP Name','SP ID','Amount','status'];                
                $wallet = DB::table('wallet_history')
                ->select('wallet_history.*','branch.name as name','branch.branch_id as sp_id')
                ->leftjoin('wallet','wallet.id','=','wallet_history.wallet_id')
                ->leftjoin('branch','branch.id','=','wallet.user_id')
                ->whereBetween('wallet_history.created_at', [$date_from,$date_to])
                ->orderBy('wallet_history.id','desc')->get();     
               
            $count = 1;
            $date = date("Y-m-d");  
            foreach ($wallet as $key => $value) {   
                $status = "Credit";
                if ($value->transaction_type == '1') {                    
                    $status = "Debit";
                }
                $data[] = [ $count,$value->created_at,$value->comment,$value->name,$value->sp_id,$value->amount,$status ];
                $count++;
            }
            return $data;
        }else{
                $data [] = ["ME JOB AMOUNT CREDIT REPORT"];
                $data[] = ['Sl No','Date','Job ID/Remarks','ME Name','Mobile No','Amount','Status']; 

                $wallet = DB::table('executive_jobs')
                ->select('executive_jobs.*','executive.name as name','executive.mobile as mobile','job.job_id as job_id')
                ->leftjoin('executive','executive.id','=','executive_jobs.executive_id')
                ->leftjoin('job','job.id','=','executive_jobs.job_id')
                ->whereBetween('executive_jobs.created_at', [$date_from,$date_to])
                ->orderBy('executive_jobs.id','desc')->get();     
            
            $count = 1;
            $date = date("Y-m-d"); 
            foreach ($wallet as $key => $value) {   
                $status = 'Waiting to credit';
                if ($value->status == '2') {                    
                    $status = 'credited to wallet';
                } 
                $data[] = [ $count,$value->created_at,$value->job_id,$value->name,$value->mobile,$value->amount,$status];
                $count++;
            }
            return $data;
        }
    }
}