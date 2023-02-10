@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Dashboard</h1>
<div class="mt-10 grid grid-cols-3 gap-10">
  <div class="w-full h-16 border-2 border-sky-400 rounded flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-sky-600">Pre Proses</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-sky-600 py-4 px-8 text-white rounded-r">{{ $total_preproses }}</span></div>
  </div>
  <div class="w-full h-16 border-2 border-amber-400 rounded flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-amber-600">Produksi</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-amber-600 py-4 px-8 text-white rounded-r">{{ $total_produksi }}</span></div>
  </div>
  <div class="w-full h-16 border-2 border-green-400 rounded flex">
    <div class="h-full w-3/4 flex items-center justify-center text-2xl text-green-600">Selesai</div>
    <div class="h-full w-1/3 flex items-center justify-end text-2xl"><span class="bg-green-600 py-4 px-8 text-white rounded-r">{{ $total_selesai }}</span></div>
  </div>
</div>
<div class="mt-6">
  <table class="w-full">
    <thead class="bg-emerald-500 text-white">
      <tr>
        <th class="p-2 rounded-tl">Id</th>
        <th class="p-2">Nama Produk</th>
        <th class="p-2">Jumlah Order</th>
        <th class="p-2">Ukuran</th>
        <th class="p-2">Tanggal</th>
        <th class="p-2 rounded-tr">Status</th>
      </tr>
    </thead>
    <tbody class="bg-emerald-100">
      @foreach ($transaksi as $key => $item)
        <tr class="border border-emerald-400">
          <td class="p-1 text-center">{{ $item->id_order }}</td>
          <td class="p-1">{{ $item->produk }}</td>
          <td class="p-1 text-center">{{ $item->jumlah_order }}</td>
          <td class="p-1 text-center">{{ $item->ukuran }}</td>
          <td class="p-1 text-center item-tanggal">
            @php
              $date = Carbon\Carbon::parse($item->tanggal_masuk)->locale('id');
              $date->settings(['formatFunction' => 'translatedFormat']);
            @endphp
            <div id="item-tanggal-{{ $item->id }}" class="cursor-pointer text-sky-700 item-tanggal" data-id="{{ $item->id }}">{{ $date->format('d-m-Y'); }}</div>
            <div class="hidden input-tanggal-{{ $item->id }}">
              <input type="date" name="item-tanggal" id="item-tanggal" class="input-tanggal" value="{{ $date->format('Y-m-d'); }}" data-id="{{ $item->id }}">
              <i class="fa fa-ban text-rose-800 ml-2 cursor-pointer input-tanggal-batal" data-id="{{ $item->id }}" title="Batal"></i>
            </div>
          </td>
          <td class="p-1 text-center">
            <div id="item-status-{{ $item->id }}" class="cursor-pointer text-sky-700 capitalize item-status" data-id="{{ $item->id }}">{{ $item->status }}</div>
            <div class="hidden select-status-{{ $item->id }}">
              <select name="status" class="outline-0 border border-emerald-600 select-status" data-id="{{ $item->id }}">
                <option value="preproses" {{ $item->status == "preproses" ? "selected" : "" }}>Preproses</option>
                <option value="produksi" {{ $item->status == "produksi" ? "selected" : "" }}>Produksi</option>
                <option value="selesai" {{ $item->status == "selesai" ? "selected" : "" }}>Selesai</option>
              </select>
              <i class="fa fa-ban text-rose-800 ml-2 cursor-pointer select-status-batal" data-id="{{ $item->id }}" title="Batal"></i>
            </div>
          </td>
        </tr>          
      @endforeach
    </tbody>
  </table>
</div>
@endsection

@section('script')
<script type="module">
  $(document).ready(function(){
    $.ajaxSetup({
      headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
    });

    // double click status
    $(".item-status").on('dblclick', function () {
      const id = $(this).attr('data-id');
      $('#item-status-' + id).addClass('hidden');
      $('.select-status-' + id).removeClass('hidden');
    });

    // onchange status
    $('.select-status').on('change', function () {
      const id = $(this).attr('data-id');
      const status = $(this).val();

      $('#item-status-' + id).empty();

      const formData = {
        update: "status",
        id: id,
        status: status
      }

      $.ajax({
        url: "{{ URL::route('dashboard.update') }}",
        type: "post",
        data: formData,
        success: function (response) {
          console.log(response);
          $('#notifikasi').removeClass('hidden');
          setTimeout(() => {
            location.reload();
          }, 1000);
        }
      })
    })

    // batal status
    $('.select-status-batal').on('click', function () {
      const id = $(this).attr('data-id');
      $('#item-status-' + id).removeClass('hidden');
      $('.select-status-' + id).addClass('hidden');
    })

    // doble click tanggal
    $(".item-tanggal").on('dblclick', function () {
      let id = $(this).attr('data-id');
      $('#item-tanggal-' + id).addClass('hidden');
      $('.input-tanggal-' + id).removeClass('hidden');
    })

    // onchange tanggal
    $('.input-tanggal').on('change', function () {
      const id = $(this).attr('data-id');
      const tanggal = $(this).val();

      $('#item-tanggal-' + id).empty();

      const formData = {
        update: "tanggal",
        id: id,
        tanggal_masuk: tanggal
      }

      $.ajax({
        url: "{{ URL::route('dashboard.update') }}",
        type: "post",
        data: formData,
        success: function (response) {
          console.log(response);
          $('#notifikasi').removeClass('hidden');
          setTimeout(() => {
            location.reload();
          }, 1000);
        }
      })
    })

    // batal tanggal
    $('.input-tanggal-batal').on('click', function () {
      const id = $(this).attr('data-id');
      $('#item-tanggal-' + id).removeClass('hidden');
      $('.input-tanggal-' + id).addClass('hidden');
    })

  });
</script>
@endsection()