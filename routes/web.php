<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\ViewUserDeskripsiController;
use App\Http\Controllers\AdminDeskripsiController;
use App\Http\Controllers\DataSensorController;
use App\Http\Controllers\AdminPesanController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\DeskripsiSensorController;
use App\Http\Controllers\ExportController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\KarbonDioksidaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TemperatureController;
use App\Http\Controllers\SoilController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
// Route::get('/', [KarbonDioksidaController::class, 'index'])->name('dashboard');
// Route::post('/esp', [DataSensorController::class, 'store']);
Route::get('/', [DashboardController::class, 'index']);
// Route::get('/', function () {
//     return view('menu.app', [
//         'title' => 'user Dashboard',
    // ]);
// });
// Route::get('/admin', function () {
//     if(auth()->guest()){
//         abort(403);
//     }
//     if(auth()->user()->role !== '1'){
//         abort(403);
//     }
//     return view('admin.adminHome', [
//         'title' => 'Admin Dashboard',
//     ]);
// });
Route::get('/temp', [TemperatureController::class, 'index']);
Route::get('/soil', [SoilController::class, 'index']);

// Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);

Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
Route::post('/register', [RegisterController::class, 'store']);

// Route::post('/dashboard', [RegisterController::class, 'store'])->middleware('auth');

Route::get('/contactus', [ContactUsController::class, 'index']);
Route::post('/contactus', [ContactUsController::class, 'store']);

Route::resource('/admin/pesan/pesan', AdminPesanController::class)->middleware('is_admin');
Route::get('/admin/pesan/pesan/{contact_us}',[AdminPesanController::class, 'show'])->middleware('is_admin');
// Route::delete('/admin/pesan/pesan/{contact_us}',[AdminPesanController::class, 'destroy'])->middleware('is_admin');
// route::post('/admin/pesan/pesan', PesanController::class)->middleware('is_admin');
 
Route::resource('/admin/deskripsi/deskripsi', AdminDeskripsiController::class)->middleware('is_admin');
Route::get('/admin/deskripsi/tambahdeskripsi', function () {
    return view('admin.deskripsi.tambahDeskripsi', [
        'title' => 'admin tambah deskripsi',
    ]);
})->middleware('is_admin');
Route::resource('/admin/lokasi/lokasi', LokasiController::class)->middleware('is_admin');
// Route::resource('/admin/lokasi/tambahlokasi', LokasiController::class, 'create')->middleware('is_admin');





// Data masuk ke database
// Route::get('/esp', [DataSensorController::class, 'store']);
// Route::post('/esp/{CO}/{NH3}/{CH4}', [DataSensorController::class, 'store']);



// export excel
Route::get('/export-temp-daily', [ExportController::class, 'exportTempDaily']);



































// Route::get('admin/home', [LoginController::class, 'index'])->name('admin.home')->middleware('is_admin');


// Route::get('/login', [LoginController::class, 'index'])->name('login')->middleware('guest');
// Route::post('/login', [LoginController::class, 'login']);
// Route::post('/logout', [LoginController::class, 'logout']);

// Route::get('/register', [RegisterController::class, 'index'])->middleware('guest');
// Route::post('/register', [RegisterController::class, 'store']);

// Route::post('/dashboard', [RegisterController::class, 'store'])->middleware('auth');

// Route::get('/data', function () {
//     return view('admin.deskripsi', [
//         'title' => 'data',
//     ]);
// });

// Route::get('/editdata', function () {
//     return view('admin.editDeskripsi', [
//         'title' => 'tambahdata',
//     ]);
// });
// Route::get('/login', function () {
//     return view('menu.login', [
//         'tittle' => 'Login',
//     ]);
// });