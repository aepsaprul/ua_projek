@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Transaksi</h1>
<div class="mt-10">
  <form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-5 gap-5">
      <div class="flex flex-col w-full">
        <label for="konsumen" class="text-lg text-slate-600 font-semibold mb-1">Nama Konsumen</label>
        <input type="text" name="konsumen" id="konsumen" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('konsumen') is-invalid @enderror" value="{{ old('konsumen') }}" placeholder="Nama Konsumen" autofocus required>
        <em class="text-rose-400 ml-1">@error('konsumen') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="produk" class="text-lg text-slate-600 font-semibold mb-1">Nama Produk</label>
        <input type="text" name="produk" id="produk" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('produk') is-invalid @enderror" value="{{ old('produk') }}" placeholder="Nama Produk" autofocus required>
        <em class="text-rose-400 ml-1">@error('produk') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="jumlah_order" class="text-lg text-slate-600 font-semibold mb-1">Jumlah Order</label>
        <input type="text" name="jumlah_order" id="jumlah_order" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('jumlah_order') is-invalid @enderror" value="{{ old('jumlah_order') }}" placeholder="Jumlah Order" required>
        <em class="text-rose-400 ml-1">@error('jumlah_order') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="panjang" class="text-lg text-slate-600 font-semibold mb-1">Panjang (cm)</label>
        <input type="number" name="panjang" id="panjang" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('panjang') is-invalid @enderror" value="{{ old('panjang') }}" placeholder="Panjang" required>
        <em class="text-rose-400 ml-1">@error('panjang') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="lebar" class="text-lg text-slate-600 font-semibold mb-1">Lebar (cm)</label>
        <input type="number" name="lebar" id="lebar" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('lebar') is-invalid @enderror" value="{{ old('lebar') }}" placeholder="Lebar" required>
        <em class="text-rose-400 ml-1">@error('lebar') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="tanggal_masuk" class="text-lg text-slate-600 font-semibold mb-1">Tanggal</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') ? old('tanggal_masuk') : date('Y-m-d') }}" required>
        <em class="text-rose-400 ml-1">@error('tanggal_masuk') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="status" class="text-lg text-slate-600 font-semibold mb-1">Status</label>
        <select name="status" id="status" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3">
          <option value="preproses">Pre Proses</option>
          <option value="produksi">Produksi</option>
          <option value="selesai">Selesai</option>
        </select>
        <em class="text-rose-400 ml-1">@error('produk') {{ $message }} @enderror</em>
      </div>
      <div class="w-full inline-flex items-end">
        <label for="status_return">
          <input type="checkbox" name="status_return" id="status_return" class="w-5 h-5 mr-2 check_return"><span>Return</span>
        </label>
      </div>
      <div class="flex-col w-full id-order hidden">
        <label for="id_return" class="text-lg text-slate-600 font-semibold mb-1">ID Order</label>
        <input type="number" name="id_return" id="id_return" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('id_return') is-invalid @enderror" value="{{ old('id_return') }}" placeholder="Masukkan ID">
        <em class="text-rose-400 ml-1">@error('id_return') {{ $message }} @enderror</em>
      </div>
    </div>
    <div class="mt-6">
      <button type="submit" class="bg-emerald-600 text-white font-semibold py-2 px-4 rounded-sm outline-0"><i class="fa fa-save mr-1"></i>Simpan</button>
    </div>
    <div class="mt-6">
      <em class="text-emerald-500 text-lg">
        @if ($message = Session::get('success')) {{ $message }} @endif
    </div>
  </form>
</div>
@endsection

@section('script')
<script type="module">
$(document).ready(function () {
  $('.check_return').on('change', function () {
    if ($('.check_return').is(':checked')) {
      $('.id-order').removeClass('hidden');
    } else {
      $('.id-order').addClass('hidden');
    }
  })
})
</script>
@endsection