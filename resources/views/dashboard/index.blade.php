@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Dashboard</h1>
<div class="mt-10 grid grid-cols-3 gap-10">
  <div class="w-full h-16 border-2 border-sky-400 rounded-md flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-sky-600">Pre Proses</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-sky-600 p-4 text-white rounded-r-md">30</span></div>
  </div>
  <div class="w-full h-16 border-2 border-amber-400 rounded-md flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-amber-600">Produksi</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-amber-600 p-4 text-white rounded-r-md">30</span></div>
  </div>
  <div class="w-full h-16 border-2 border-green-400 rounded-md flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-green-600">Selesai</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-green-600 p-4 text-white rounded-r-md">30</span></div>
  </div>
</div>
<div class="mt-6">
  <table class="w-full">
    <thead class="bg-emerald-500 text-white">
      <tr>
        <th class="p-2 rounded-tl-md">Id</th>
        <th class="p-2">Nama Produk</th>
        <th class="p-2">Jumlah Order</th>
        <th class="p-2">Ukuran</th>
        <th class="p-2">Tanggal</th>
        <th class="p-2 rounded-tr-md">Status</th>
      </tr>
    </thead>
    <tbody class="bg-emerald-100">
      @foreach ($transaksi as $key => $item)
        <tr>
          <td class="p-1 text-center">{{ $key + 1 }}</td>
          <td class="p-1">{{ $item->produk }}</td>
          <td class="p-1 text-center">{{ $item->jumlah_order }}</td>
          <td class="p-1 text-center">{{ $item->ukuran }}</td>
          <td class="p-1 text-center item-tanggal">
            @php
              $date = Carbon\Carbon::parse($item->tanggal_masuk)->locale('id');
              $date->settings(['formatFunction' => 'translatedFormat']);
            @endphp
            <div class="cursor-pointer text-sky-700">{{ $date->format('d-m-Y'); }}</div>
          </td>
          <td class="p-1 text-center item-status">
            <div class="cursor-pointer text-sky-700">{{ $item->status }}</div>
            <select name="status" id="status" class="hidden">
              <option value="preproses">Preproses</option>
              <option value="produksi">Produksi</option>
              <option value="selesai">Selesai</option>
            </select>
          </td>
        </tr>          
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')

@endsection