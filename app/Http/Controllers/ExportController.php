<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\Ch4ExportHarian;
use App\Exports\Ch4ExportBulanan;
use App\Models\Wilayah;
use App\Models\data_sensors;
use App\Exports\CoExportBulanan;
use App\Exports\CoExportHarian;
use App\Exports\Nh3ExportHarian;
use App\Exports\Nh3ExportBulanan;

use App\Exports\ExportTempDaily;

use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    public function exportTempDaily(){
        return Excel::download(new exportTempDaily)->withFileName('temperature.xlsx');
    }
   
}
