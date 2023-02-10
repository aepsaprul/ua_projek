<?php

namespace App\Http\Controllers;

use App\Models\UaTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransaksiController extends Controller
{
  public function index()
  {
    return view('transaksi.index');
  }
  public function store(Request $request)
  {
    $transaksi = new UaTransaksi;
    $transaksi->id_order = random_int(111111,999999);
    $transaksi->produk = $request->produk;
    $transaksi->jumlah_order = $request->jumlah_order;
    $transaksi->ukuran = $request->ukuran;
    $transaksi->tanggal_masuk = $request->tanggal_masuk;
    $transaksi->status = $request->status;
    if ($request->status_return) {
      $transaksi->status_return = 'y';
      $transaksi->id_return = $request->id_return;
    }
    $transaksi->save();

    return redirect()->route('transaksi')->with('success', 'Sukses! Data berhasil disimpan');
  }
}
