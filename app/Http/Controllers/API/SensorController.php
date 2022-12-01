<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SensorController
{
    public function create(Request $request)
    {
        try {
            $data = $request->all();
            $insert = DB::table('data_sensors')->insert($data);
            return response()->json([
                "status" => "ok",
            ]);
        } catch (\Throwable $th) {
            return response()->json([
                "status" => "error",
                "message" => $th->getMessage()
            ]);
        }
    }  
}