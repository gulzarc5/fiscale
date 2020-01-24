<?php
namespace App\Exports;

use App\Invoice;
use Maatwebsite\Excel\Concerns\FromArray;
use DB;
use auth;
use Carbon\Carbon;

class ClientJobReport implements FromArray
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
        
        $branch_id = Auth::guard('branch')->user()->id;
        $date_from = Carbon::parse($this->start_date)->startOfDay();
        $date_to = Carbon::parse($this->end_date)->endOfDay();
        $job = DB::table('job')
            ->select('job.*','client.client_id as c_id','client.name as c_name','job_type.name as job_type_name','branch.name as branch_name')
            ->leftjoin('client','client.id','=','job.client_id')
            ->leftjoin('branch','branch.id','=','job.created_by_id')
            ->leftjoin('job_type','job_type.id','=','job.job_type')
            ->where('job.created_by_id',$branch_id)
            ->orWhereBetween('job.created_at', [$date_from,$date_to])
            ->orderBy('job.id','desc')->get();

        $data[] = ['Sl No','Job Id','Client Id','Client Name','Job Description','Date','Status','Close Date']; 
        $count = 1;
        foreach ($job as $key => $value) {
            $status = "Processing";
            if ($value->status == '2') {
                $status = "Working";
            } elseif($value->status == '3') {
                $status = "Document Problem";
            } elseif($value->status == '4') {
                $status = "Closed";
            }
            
            $data[] = [ $count,$value->job_id, $value->c_id,  $value->c_name,  $value->job_type_name,  $value->created_at, $status,$value->completed_date,];
            $count++;
        }
        return $data;
    }
}