<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
use auth;

class EmployeeReport implements FromArray
{
    private $start_date;
    private $end_date;
    public function __construct($start_date,$end_date)
    {
        $this->start_date = $start_date;
        $this->end_date = $end_date;
    }
    
    public function array(): array
    {
        
        $emp_id = Auth::guard('employee')->user()->id;

        $job = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','job_type.name as job_type_name','branch.name as branch_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.status',4)
            ->where('job.assign_to_id',$emp_id)
            ->orWhereBetween('job.completed_date', [$this->start_date,$this->end_date])
            ->orderBy('job.assigned_date','desc')->get();

        $data[] = ['Sl No','Assign Date','Client Name','Job Description','Close Date']; 
        $count = 1;
        foreach ($job as $key => $value) {            
            $data[] = [ $count, $value->assigned_date,  $value->c_name,  $value->job_type_name,  $value->completed_date];
            $count++;
        }
        return $data;
    }
}