@extends('layouts.app')

@section('content')
<h1 class="text-3xl">Transaksi</h1>
<div class="mt-10">
  <form action="{{ route('transaksi.store') }}" method="POST">
    @csrf
    <div class="grid grid-cols-5 gap-5">
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
        <label for="ukuran" class="text-lg text-slate-600 font-semibold mb-1">Ukuran (cm)</label>
        <input type="number" name="ukuran" id="ukuran" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('ukuran') is-invalid @enderror" value="{{ old('ukuran') }}" placeholder="Ukuran" required>
        <em class="text-rose-400 ml-1">@error('ukuran') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="tanggal_masuk" class="text-lg text-slate-600 font-semibold mb-1">Tanggal</label>
        <input type="date" name="tanggal_masuk" id="tanggal_masuk" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('tanggal_masuk') is-invalid @enderror" value="{{ old('tanggal_masuk') ? old('tanggal_masuk') : date('Y-m-d') }}" required>
        <em class="text-rose-400 ml-1">@error('tanggal_masuk') {{ $message }} @enderror</em>
      </div>
      <div class="flex flex-col w-full">
        <label for="status" class="text-lg text-slate-600 font-semibold mb-1">Status</label>
        {{-- <input type="text" name="produk" id="produk" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3 @error('produk') is-invalid @enderror" placeholder="Nama Produk" required> --}}
        <select name="status" id="status" class="border border-emerald-400 outline-none rounded-sm h-9 pl-3">
          <option value="preproses">Pre Proses</option>
          <option value="produksi">Produksi</option>
          <option value="selesai">Selesai</option>
        </select>
        <em class="text-rose-400 ml-1">@error('produk') {{ $message }} @enderror</em>
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