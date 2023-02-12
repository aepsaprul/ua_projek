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
<div class="mt-8">
  <div class="mb-5 flex justify-between">
    <div>
      <form action="{{ route('transaksi.export') }}" method="POST">
        @csrf
        <input type="date" name="start_date" id="start_date" class="border border-emerald-400 py-1.5 px-2 rounded" value="{{ date('Y-m-d') }}">
        <span>s/d</span>
        <input type="date" name="end_date" id="end_date" class="border border-emerald-400 py-1.5 px-2 rounded" value="{{ date('Y-m-d') }}">
        <button type="button" id="btn-cari" class="ml-5 py-2 px-4 bg-emerald-400 text-white font-bold rounded">Cari <i class="fa fa-search ml-2"></i></button>
        <button type="submit" id="btn-excel" class="py-2 px-4 bg-emerald-400 text-white font-bold rounded">Excel <i class="fa fa-list ml-2"></i></button>
      </form>
    </div>
    <div>
      <input type="text" name="filter-produk" id="filter-produk" placeholder="Ketik Nama Produk" class="border border-emerald-400 py-1.5 px-2 rounded">
      <select name="filter-status" id="filter-status" class="border border-emerald-400 py-1.5 px-3 w-52 rounded">
        <option value="">Pilih Status</option>
        <option value="preproses">Preproses</option>
        <option value="produksi">Produksi</option>
        <option value="selesai">Selesai</option>
      </select>
    </div>
  </div>
  <div class="tabel-transaksi"></div>
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

    // filter cari
    $('#btn-cari').on('click', function (e) {
      e.preventDefault();
      $('#paginated-list').empty();
      const start_date = $('#start_date').val();
      const end_date = $('#end_date').val();
      
      let formData = {
        filter: "cari",
        start_date: start_date,
        end_date: end_date
      }

      $.ajax({
        url: "{{ URL::route('dashboard.tabelTransaksiAjax') }}",
        type: "post",
        data: formData,
        success: function (response) {
          $('.tabel-transaksi').html(response);
        }
      })
    })

    // filter produk
    $('#filter-produk').on('keyup', function () {
      const val = $(this).val();
      
      let formData = {
        filter: "produk",
        produk: val
      }

      $.ajax({
        url: "{{ URL::route('dashboard.tabelTransaksiAjax') }}",
        type: "post",
        data: formData,
        success: function (response) {
          $('.tabel-transaksi').html(response);
        }
      })
    })

    // filter status
    $('#filter-status').on('change', function () {
      const val = $(this).val();
      $('#paginated-list').empty();
      let formData = {
        filter: "status",
        status: val
      }
      
      $.ajax({
        url: "{{ URL::route('dashboard.tabelTransaksiAjax') }}",
        type: "post",
        data: formData,
        success: function (response) {
          $('.tabel-transaksi').html(response);
        }
      })
    })

    // tabel
    tabelTransaksi();
    function tabelTransaksi() {
      $.ajax({
        url: "{{ URL::route('dashboard.tabelTransaksi') }}",
        type: "get",
        success: function (response) {
          $('.tabel-transaksi').html(response);
        }
      })
    }
  });
</script>
@endsection