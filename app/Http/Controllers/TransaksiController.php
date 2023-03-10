<?php

namespace App\Http\Controllers;

use App\Exports\TransaksiExport;
use App\Models\UaTransaksi;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;

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
    $transaksi->konsumen = $request->konsumen;
    $transaksi->jumlah_order = $request->jumlah_order;
    $transaksi->panjang = $request->panjang;
    $transaksi->lebar = $request->lebar;
    $transaksi->tanggal_masuk = $request->tanggal_masuk;
    $transaksi->status = $request->status;
    $transaksi->deadline = $request->deadline;
    $transaksi->keterangan = $request->keterangan;
    if ($request->status_return) {
      $transaksi->status_return = 'y';
      $transaksi->id_return = $request->id_return;
    }
    $transaksi->save();

    return redirect()->route('transaksi')->with('success', 'Sukses! Data berhasil disimpan');
  }
  public function export(Request $request)
  {
    $startDate = $request->start_date;
    $endDate = $request->end_date;
    return Excel::download(new TransaksiExport($startDate, $endDate), 'transaksi.xlsx');
  }
}
