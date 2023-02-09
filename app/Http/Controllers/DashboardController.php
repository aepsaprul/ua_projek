<?php

namespace App\Http\Controllers;

use App\Models\UaTransaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $transaksi = UaTransaksi::get();

    return view('dashboard.index', ['transaksi' => $transaksi]);
  }
}
