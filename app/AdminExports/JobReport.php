<?php
namespace App\AdminExports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
use Auth;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithEvents;
use Carbon\Carbon;

class JobReport implements FromArray,ShouldAutoSize,WithEvents
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
                if ($this->type == '1') {
                    $styleCellRange = 'A2:G2'; // All headers
                    $mergeCellRange = 'A1:G1';
                }else if ($this->type == '2') {
                    $styleCellRange = 'A2:K2'; // All headers
                    $mergeCellRange = 'A1:K1';
                }else if ($this->type == '3') {
                    $styleCellRange = 'A2:J2'; // All headers
                    $mergeCellRange = 'A1:J1';
                }else if ($this->type == '4') {
                    $styleCellRange = 'A2:J2'; // All headers
                    $mergeCellRange = 'A1:J1';
                }else{
                    $styleCellRange = 'A2:H2'; // All headers
                    $mergeCellRange = 'A1:H1';
                }
                
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($styleCellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells($mergeCellRange);
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 15,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($mergeCellRange)->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
        $date_from = Carbon::parse($this->start_date)->startOfDay();
        $date_to = Carbon::parse($this->end_date)->endOfDay();
        $job = DB::table('job')
            ->select('job.*','job_type.name as job_name','branch.name as branch_name','branch.branch_id as branch_id','client.name as client_name','client.pan as client_pan','employee.name as emp_name')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('employee','employee.id','=','job.assign_to_id')
            ->whereBetween('job.created_at', [$date_from,$date_to]);
        if ($this->type == '1') {            
            $jobs = $job->where('job.status',1)
                ->get();
            $data [] = ["PENDING JOB LIST"];
            $data[] = ['Sl No','Date Of Entry','Job Id','SP Name','SP ID','Pan','Client Name','Job Description']; 
            $count = 1;
            foreach ($jobs as $key => $value) {          
                $data[] = [ $count,$value->created_at,$value->job_id,$value->branch_name,$value->branch_id,$value->client_pan,$value->client_name,  $value->job_name];
                $count++;
            }
            return $data;
        }elseif ($this->type == '2') {            
            $jobs = $job->where('job.status',4)
                ->get();
            $data [] = ["Completed JOB LIST"];
            $data[] = ['Sl No','Date Of Entry','Job Id','SP Name','SP ID','Pan','Client Name','Job Description','Assign Date','Assign To','Completion Date']; 
            $count = 1;
            foreach ($jobs as $key => $value) {          
                $data[] = [ $count,$value->created_at,$value->job_id,$value->branch_name,$value->branch_id,$value->client_pan,$value->client_name,  $value->job_name,$value->assigned_date,$value->emp_name,$value->completed_date];
                $count++;
            }
            return $data;
        }elseif ($this->type == '3') {            
            $jobs = $job->where('job.status',3)
                ->get();
            $data [] = ["CORRECTION JOB LIST"];
            $data[] = ['Sl No','Date Of Entry','Job Id','SP Name','SP ID','Pan','Client Name','Job Description','Assign Date','Assign To']; 
            $count = 1;
            foreach ($jobs as $key => $value) {          
                $data[] = [ $count,$value->created_at,$value->job_id,$value->branch_name,$value->branch_id,$value->client_pan,$value->client_name,  $value->job_name,$value->assigned_date,$value->emp_name];
                $count++;
            }
            return $data;
        }elseif ($this->type == '4') {            
            $jobs = $job->where('job.status',2)
                ->where('job.employee_assignment_status',1)
                ->get();
            $data [] = ["ASSIGNED JOB LIST"];
            $data[] = ['Sl No','Date Of Entry','Job Id','SP Name','SP ID','Pan','Client Name','Job Description','Assign Date','Assign To']; 
            $count = 1;
            foreach ($jobs as $key => $value) {          
                $data[] = [ $count,$value->created_at,$value->job_id,$value->branch_name,$value->branch_id,$value->client_pan,$value->client_name,  $value->job_name,$value->assigned_date,$value->emp_name];
                $count++;
            }
            return $data;
        }else{
            $jobs = $job->where('job.employee_assignment_status',2)
                ->get();
            $data [] = ["Rejected JOB LIST"];
            $data[] = ['Sl No','Date Of Entry','Job Id','SP Name','SP ID','Pan','Client Name','Job Description']; 
            $count = 1;
            foreach ($jobs as $key => $value) {          
                $data[] = [ $count,$value->created_at,$value->job_id,$value->branch_name,$value->branch_id,$value->client_pan,$value->client_name,  $value->job_name];
                $count++;
            }
            return $data;
        }
     
        
    }
}