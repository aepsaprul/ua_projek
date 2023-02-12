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
  <tbody id="paginated-list" class="bg-emerald-100">
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
<div class="pagination-container mt-5">  
  <div id="pagination-numbers" class="text-center"></div>
</div>

<script type="module">
  afPagination(10);
</script>