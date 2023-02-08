<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
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

Route::get('/', function () {
  return view('welcome');
});

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('login/auth', [LoginController::class, 'auth'])->name('login.auth');

Route::middleware(['auth', 'prevent-back-history'])->group(function () {
  Route::post('logout', [LoginController::class, 'logout'])->name('logout');
  Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
});
