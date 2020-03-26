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

class MarketingExecutiveList implements FromArray,ShouldAutoSize,WithEvents
{
   

    public function registerEvents(): array
    {
        return [
            AfterSheet::class    => function(AfterSheet $event) {
                $cellRange = 'A2:I2'; // All headers
                $style_head = array(
                    'font'  => array(
                        'bold'  => true,
                        'name'  => 'Verdana'
                    ),
                    'alignment' => array('horizontal' => 'center') ,
                );
                $event->sheet->getDelegate()->getStyle($cellRange)->applyFromArray($style_head);
                $event->sheet->mergeCells('A1:I1');
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
     
        $employee = DB::table('executive')->get();
        $data [] = ["Marketing Executive List"];
        $data[] = ['Sl No','ME Name','Mobile','Email','Address','City','PIN','State','Total No of Service Points']; 
        $count = 1;
        foreach ($employee as $key => $value) {      
            $total_sp = DB::table('branch')->where('executive_id',$value->id)->count();      
            $data[] = [ $count,$value->name,$value->mobile,$value->email_id,$value->address,  $value->city,  $value->pin,  $value->state,$total_sp];
            $count++;
        }
        return $data;
    }
}