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

class MemberList implements FromArray,ShouldAutoSize,WithEvents
{
   

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
     
        $employee = DB::table('employee')->get();
        $data [] = ["Member List"];
        $data[] = ['Sl No','Mem Name','Mobile','Email','Address','City','PIN','State']; 
        $count = 1;
        foreach ($employee as $key => $value) {            
            $data[] = [ $count,$value->name,$value->mobile,$value->email,$value->address,  $value->city,  $value->pin,  $value->state];
            $count++;
        }
        return $data;
    }
}