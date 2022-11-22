<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\data_sensors;

class SensorController extends Controller
{
    public function storeHumidity(Request $request)
    {
        $humidity = $request->humidity;
        data_sensor::insert($humidity);
    }  
}