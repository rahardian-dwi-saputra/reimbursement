<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ReimbursementController;

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
    return view('welcome');
});
Route::get('/login', [AuthController::class, 'index'])->middleware('guest:webkaryawan')->name('login');

Route::middleware('auth:webkaryawan')->group(function(){ 
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::resource('reimbursement', ReimbursementController::class);
	Route::resource('karyawan', KaryawanController::class);
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'authenticate']);