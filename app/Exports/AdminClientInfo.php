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

class AdminClientInfo implements FromArray,ShouldAutoSize
{
    private $client_id;
    public function __construct($client_id)
    {
        $this->client_id = $client_id;
    }
    
    public function array(): array
    {
        $data = [];
        $client_personal = DB::table('client')->where('id',$this->client_id)->first();
        $data[] = [$client_personal->name];
        $data[] = [$client_personal->father_name];
        $data[] = [$client_personal->dob];
        $data[] = [$client_personal->pan];
        $data[] = [$client_personal->constitution];
        if ($client_personal->gender == 'M') {
            $data[] = ["Male"];
        } else {
            $data[] = ["FeMale"];
        }
        $data[] = [$client_personal->mobile];
        $data[] = [$client_personal->email];


        $res_addr = null;
        $business_addr = null;
        $job_det = null;
        if ($client_personal) {
            $res_addr = DB::table('address')->where('id',$client_personal->residential_addr_id)->first();
            $data[] = [$res_addr->flat_no];
            $data[] = [$res_addr->village];
            $data[] = [$res_addr->po];
            $data[] = [$res_addr->ps];
            $data[] = [$res_addr->area];
            $data[] = [$res_addr->dist];
            $data[] = [$res_addr->state];
            $data[] = [$res_addr->pin];
            $business_addr = DB::table('address')->where('id',$client_personal->business_addr_id)->first();

            $data[] = [$business_addr->flat_no];
            $data[] = [$business_addr->village];
            $data[] = [$business_addr->po];
            $data[] = [$business_addr->ps];
            $data[] = [$business_addr->area];
            $data[] = [$business_addr->dist];
            $data[] = [$business_addr->state];
            $data[] = [$business_addr->pin];
        }
        $data[] = [$client_personal->trade_name];
        return $data;
    }
}