<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\KaryawanController;
use App\Http\Controllers\ReimbursementController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\PersetujuanController;
use App\Http\Controllers\PembayaranController;

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

/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/', [AuthController::class, 'index'])->middleware('guest:webkaryawan');
Route::get('/login', [AuthController::class, 'index'])->middleware('guest:webkaryawan')->name('login');

Route::middleware('auth:webkaryawan')->group(function(){ 
	Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
	Route::get('/profilsaya', [ProfilController::class, 'index']);

	Route::resource('reimbursement', ReimbursementController::class);
	Route::get('/display_pdf/{reimbursement}', [PdfController::class, 'display_dokumen']);
	Route::post('/kirimpengajuan/{reimbursement}', [ReimbursementController::class, 'kirim_pengajuan']);

	Route::middleware('can:isDirektur')->group(function(){
		Route::resource('karyawan', KaryawanController::class);
		Route::get('/daftar/reimbursement', [PersetujuanController::class, 'index']);
		Route::get('/validasi/reimbursement/{reimbursement}', [PersetujuanController::class, 'validasi']);
		Route::post('/validasi/reimbursement/{reimbursement}', [PersetujuanController::class, 'kirim_validasi']);
		Route::get('/detail/reimbursement/{reimbursement}', [PersetujuanController::class, 'show']);
	});

	Route::middleware('can:isFinance')->group(function(){

		Route::get('/finance/reimbursement', [PembayaranController::class, 'index']);
		Route::get('/finance/reimbursement/{reimbursement}', [PembayaranController::class, 'show']);
		Route::get('/finance/validasi/{reimbursement}', [PembayaranController::class, 'validasi']);
		Route::post('/finance/validasi/{reimbursement}', [PembayaranController::class, 'kirim_validasi']);
		Route::get('/finance/buktipembayaran/{reimbursement}', [PembayaranController::class, 'input_bukti_pembayaran']);
		Route::post('/finance/buktipembayaran/{reimbursement}', [PembayaranController::class, 'upload_bukti_pembayaran']);

	});
	
	Route::post('/logout', [AuthController::class, 'logout']);
});

Route::post('/login', [AuthController::class, 'authenticate']);