<?php

namespace App\Http\Controllers;

use App\Models\UaTransaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $transaksi = UaTransaksi::get();
    $transaksi_preproses = UaTransaksi::where('status', 'preproses')->get();
    $transaksi_produksi = UaTransaksi::where('status', 'produksi')->get();
    $transaksi_selesai = UaTransaksi::where('status', 'selesai')->get();

    // total
    $total_preproses = count($transaksi_preproses);
    $total_produksi = count($transaksi_produksi);
    $total_selesai = count($transaksi_selesai);

    return view('dashboard.index', [
      'transaksi' => $transaksi,
      'total_preproses' => $total_preproses,
      'total_produksi' => $total_produksi,
      'total_selesai' => $total_selesai
    ]);
  }
  public function tabelTransaksi()
  {
    $transaksi = UaTransaksi::get();

    return view('dashboard.tabelTransaksi', [
      'transaksi' => $transaksi
    ]);
  }
  public function tabelTransaksiAjax(Request $request)
  {
    if ($request->filter == "cari") {
      $transaksi = UaTransaksi::whereBetween('tanggal_masuk', [$request->start_date, $request->end_date])->get();
    } else if ($request->filter == "produk") {
      $transaksi = UaTransaksi::where('produk', 'like', '%'. $request->produk .'%')->limit(20)->get();
    } else {
      $transaksi = UaTransaksi::where('status', $request->status)->get();
    }

    return view('dashboard.tabelTransaksi', [
      'transaksi' => $transaksi
    ]);
  }
  public function update(Request $request)
  {
    $transaksi = UaTransaksi::find($request->id);

    if ($request->update == "status") {
      $transaksi->status = $request->status;  
    } else {
      $transaksi->tanggal_masuk = $request->tanggal_masuk;
    }

    $transaksi->save();
    
    return response()->json([
      'status' => $request->all()
    ]);
  }
}
