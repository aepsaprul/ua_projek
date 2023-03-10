<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TransaksiController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [LoginController::class, 'index'])->name('login');

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
  Route::post('logout', [LoginController::class, 'logout'])->name('logout');

  // dashboard
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
  Route::get('dashboard/tabel-transaksi', [DashboardController::class, 'tabelTransaksi'])->name('dashboard.tabelTransaksi');
  Route::post('dashboard/tabel-transaksi-ajax', [DashboardController::class, 'tabelTransaksiAjax'])->name('dashboard.tabelTransaksiAjax');
  Route::post('dashboard/update', [DashboardController::class, 'update'])->name('dashboard.update');

  // transaksi
  Route::get('transaksi', [TransaksiController::class, 'index'])->name('transaksi');
  Route::post('transaksi/store', [TransaksiController::class, 'store'])->name('transaksi.store');
});
Route::post('transaksi/export', [TransaksiController::class, 'export'])->name('transaksi.export');
