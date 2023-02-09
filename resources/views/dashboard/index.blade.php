@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Dashboard</h1>
<div class="mt-10">
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
          <td class="p-1 text-center">
            @php
              $date = Carbon\Carbon::parse($item->tanggal_masuk)->locale('id');
              $date->settings(['formatFunction' => 'translatedFormat']);
            @endphp
            {{ $date->format('d-m-Y'); }}
          </td>
          <td class="p-1 text-center">{{ $item->status }}</td>
        </tr>          
      @endforeach
    </tbody>
  </table>
</div>
@endsection