<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DokterController;
use App\Http\Controllers\Admin\ObatController;
use App\Http\Controllers\Admin\PasienController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
//grup Route Untuk admin
Route::prefix('admin')->group(function(){
    // Route untuk auth
    Route::group(['middleware' => 'auth'], function(){
        //Buat route untuk Dashboard
        Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard.index');
        // buat route untuk data kategori
        Route::resource('/dokter', DokterController::class, ['as'=> 'admin']);
        // buat route untuk data Pasien
        Route::resource('/pasien', PasienController::class, ['as'=> 'admin']);
        // buat route untuk data Obat
        Route::resource('/obat', ObatController::class, ['as'=> 'admin']);
    });
});