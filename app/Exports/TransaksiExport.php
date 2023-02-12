<?php

namespace App\Exports;

use App\Models\UaTransaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class TransaksiExport implements FromView
{
  public function __construct($startDate, $endDate)
  {
      $this->startDate = $startDate;
      $this->endDate = $endDate;
  }
  
  public function view(): View
  {
      return view('dashboard.export.transaksi', [
          'transaksi' => UaTransaksi::whereBetween('tanggal_masuk', [$this->startDate, $this->endDate])
          ->get()
      ]);
  }
}
