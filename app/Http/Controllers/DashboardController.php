<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\data_sensors;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index() {
        $id = 1;
        $dataNow = DB::table('data_sensors')->where('id_wilayah', $id)
        ->latest('created_at')
        ->first();
        //get data chart
        $temp = data_sensors::with('wilayah')->select(DB::raw("SUM(temperature)/COUNT(temperature) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw('DATE_FORMAT(data_sensors.created_at, "%d %b %Y") as day'))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->where('id_wilayah', $id)
            ->groupBy('day_name', 'day')
            ->orderBy( 'day')
            ->get();
        $tempMonthly = data_sensors::with('wilayah')->select(DB::raw("SUM(temperature)/COUNT(temperature) as count"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw('DATE_FORMAT(data_sensors.created_at, "%b %Y") as month'))
            ->where('created_at', '>', Carbon::today()->subMonth(12))
            ->where('id_wilayah', $id)
            ->groupBy('month_name','month')
            ->orderBy('month')
            ->get();
        $soil = data_sensors::with('wilayah')->select(DB::raw("SUM(soil_moisture)/COUNT(soil_moisture) as count"), DB::raw("DAYNAME(created_at) as day_name"), DB::raw('DATE_FORMAT(data_sensors.created_at, "%d %b %Y") as day'))
            ->where('created_at', '>', Carbon::today()->subDay(6))
            ->where('id_wilayah', $id)
            ->groupBy('day_name','day')
            ->orderBy('day')
            ->get();
        $soilMonthly = data_sensors::with('wilayah')->select(DB::raw("SUM(soil_moisture)/COUNT(soil_moisture) as count"), DB::raw("MONTHNAME(created_at) as month_name"), DB::raw('DATE_FORMAT(data_sensors.created_at, "%b %Y") as month'))
            ->where('created_at', '>', Carbon::today()->subMonth(12))
            ->where('id_wilayah', $id)
            ->groupBy('month_name','month')
            ->orderBy('month')
            ->get();
        //parsing data chart
        $tempDataDay = [];
        $tempDataMonth = [];
        $soilDataDay = [];
        $soilDataMonth = [];

        foreach($temp as $row) {
            $tempDataDay['label'][] = $row->day;
            $tempDataDay['data'][] = (float) $row->count;
        }
        foreach($tempMonthly as $row) {
            $tempDataMonth['label'][] = $row->month;
            $tempDataMonth['data'][] = (float) $row->count;
        }

        foreach($soil as $row) {
            $soilDataDay['label'][] = $row->day;
            $soilDataDay['data'][] = (float) $row->count;
        }
        foreach($soilMonthly as $row) {
            $soilDataMonth['label'][] = $row->month;
            $soilDataMonth['data'][] = (float) $row->count;
        }
        
        return view('dashboard', [
            "dataNow" => $dataNow,
            "title" => 'user dashboard',
            'temp' => json_encode($tempDataDay),
            'tempMonthly' => json_encode($tempDataMonth),
            'soil' => json_encode($soilDataDay),
            'soilMonthly' => json_encode($soilDataMonth)
        ]);
    }
}