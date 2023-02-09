<?php

namespace App\Http\Controllers;

use App\Models\UaTransaksi;
use Illuminate\Http\Request;

class TransaksiController extends Controller
{
  public function index()
  {
    return view('transaksi.index');
  }
  public function store(Request $request)
  {
    $transaksi = new UaTransaksi;
    $transaksi->produk = $request->produk;
    $transaksi->jumlah_order = $request->jumlah_order;
    $transaksi->ukuran = $request->ukuran;
    $transaksi->tanggal_masuk = $request->tanggal_masuk;
    $transaksi->status = $request->status;
    $transaksi->save();

    return redirect()->route('transaksi')->with('success', 'Sukses! Data berhasil disimpan');
  }
}
