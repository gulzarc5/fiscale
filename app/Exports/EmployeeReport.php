<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
use Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;

class EmployeeReport implements FromArray,ShouldAutoSize,WithEvents
{
    private $start_date;
    private $end_date;
    private $type;
    public function __construct($start_date,$end_date,$type)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
        $this->type = $type;
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
        
        $emp_id = Auth::guard('employee')->user()->id;
        $date_from = Carbon::parse($this->start_date)->startOfDay();
        $date_to = Carbon::parse($this->end_date)->endOfDay();
        
     
        $job = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','client.pan as c_pan','job_type.name as job_type_name','branch.name as branch_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.assign_to_id',$emp_id)
            ->where('job.employee_assignment_status',1);
            if (isset($this->type) && !empty($this->type)) {
                if ($this->type == '1') {
                    $job = $job->where('job.status','<',3)
                    ->whereBetween('job.assigned_date', [$this->start_date,$this->end_date]);
                } elseif ($this->type == '2') {
                    $job = $job->where('job.status',3)
                    ->whereBetween('job.assigned_date', [$this->start_date,$this->end_date]);
                }else{
                    $job = $job->where('job.status',4)                    
                        ->whereBetween('job.completed_date', [$this->start_date,$this->end_date]);
                }
            }
            $job = $job->orderBy('job.assigned_date','desc')->get();
       
        
            if ($this->type == '1') {
                $data [] = ["Employee Report Of Pending Jobs"];
            }elseif ($this->type == '2') {
                $data [] = ["Employee Report Of Correction Jobs"];
            }else {
                $data [] = ["Employee Report Of Closed Jobs"];
            }

        $data[] = ['Sl No','Job Id','Pan','SP Name','Assign Date','Client Name','Job Description','Close Date']; 
        $count = 1;
        foreach ($job as $key => $value) {            
            $data[] = [ $count,$value->job_id,$value->c_pan,$value->branch_name,$value->assigned_date,  $value->c_name,  $value->job_type_name,  $value->completed_date];
            $count++;
        }
        return $data;
    }
}