<?php

namespace App\Http\Controllers;

use App\Models\UaTransaksi;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
  public function index()
  {
    $transaksi = UaTransaksi::orderBy('id', 'desc')->get();
    $transaksi_preproses = UaTransaksi::where('status', 'preproses')->get();
    $transaksi_produksi = UaTransaksi::where('status', 'produksi')->get();
    $transaksi_selesai = UaTransaksi::where('status', 'selesai')->get();
    $transaksi_batal = UaTransaksi::where('status', 'batal')->get();

    // total
    $total_preproses = count($transaksi_preproses);
    $total_produksi = count($transaksi_produksi);
    $total_selesai = count($transaksi_selesai);
    $total_batal = count($transaksi_batal);

    return view('dashboard.index', [
      'transaksi' => $transaksi,
      'total_preproses' => $total_preproses,
      'total_produksi' => $total_produksi,
      'total_selesai' => $total_selesai,
      'total_batal' => $total_batal
    ]);
  }
  public function tabelTransaksi()
  {
    $transaksi = UaTransaksi::orderBy('id', 'desc')->get();

    return view('dashboard.tabelTransaksi', [
      'transaksi' => $transaksi
    ]);
  }
  public function tabelTransaksiAjax(Request $request)
  {
    if ($request->filter == "cari") {
      $transaksi = UaTransaksi::whereBetween('tanggal_masuk', [$request->start_date, $request->end_date])->orderBy('id', 'desc')->get();
    } else if ($request->filter == "produk") {
      $transaksi = UaTransaksi::where('produk', 'like', '%'. $request->produk .'%')->limit(20)->orderBy('id', 'desc')->get();
    } else {
      $transaksi = UaTransaksi::where('status', $request->status)->orderBy('id', 'desc')->get();
    }

    return view('dashboard.tabelTransaksi', [
      'transaksi' => $transaksi
    ]);
  }
  public function update(Request $request)
  {
    $transaksi = UaTransaksi::find($request->id);

    if ($request->update == "status") {
      if ($request->status == "produksi") {
        $transaksi->tanggal_produksi = date('Y-m-d');
      } else if ($request->status == "selesai") {
        $transaksi->tanggal_selesai = date('Y-m-d');
      } else if ($request->status == "batal") {
        $transaksi->tanggal_batal = date('Y-m-d');
      }
      $transaksi->status = $request->status;  
    } else if ($request->update == "tanggal_masuk") {
      $transaksi->tanggal_masuk = $request->tanggal_masuk;
    } else if ($request->update == "deadline") {
      $transaksi->deadline = $request->deadline;
    }

    $transaksi->save();
    
    return response()->json([
      'status' => $request->all()
    ]);
  }
}
