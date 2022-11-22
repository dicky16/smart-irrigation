<?php

namespace App\Exports;
use App\Models\data_sensors;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;

class ExportTempDaily implements FromCollection
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $temp = data_sensors::select(DB::raw("SUM(temperature)/COUNT(temperature) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw("DAY(created_at) as day"))
        ->where('created_at', '>', Carbon::today()->subDay(6))
        ->where('wilayah', '1')
        ->groupBy('day_name','day')
        ->orderBy('day')
        ->get(); 
        return $temp;
    }
}
