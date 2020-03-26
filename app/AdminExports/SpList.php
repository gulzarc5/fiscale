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

class SpList implements FromArray,ShouldAutoSize,WithEvents
{
   

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:J2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:J1');
                $styleArray = array(
                    'font'  => array(
                        'bold'  => true,
                        'size'  => 15,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle('A1:I1')->applyFromArray($styleArray);
            },
        ];
    }
    
    public function array(): array
    {
     
        $branch = DB::table('branch')
            ->select('branch.*','executive.name as exe_name')
            ->leftjoin('executive','executive.id','=','branch.executive_id')
            ->get();
        $data [] = ["Service Point List"];
        $data[] = ['Sl No','SP Name','SP ID','Mobile','Email','Address','City','PIN','State','Under Marketing Executive']; 
        $count = 1;
        foreach ($branch as $key => $value) {      
            $total_sp = DB::table('branch')->where('executive_id',$value->id)->count();      
            $data[] = [ $count,$value->name,$value->branch_id,$value->mobile,$value->email,$value->address,  $value->city,  $value->pin,  $value->state,$value->exe_name];
            $count++;
        }
        return $data;
    }
}