<table border="1">
  <thead>
  <tr>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">No</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">ID Order</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">Produk</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">Ukuran</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">Tanggal Masuk</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">Status</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">Status Return</th>
    <th style="background-color: #50C878; font-weight: bold; text-align: center;">ID Return</th>
  </tr>
  </thead>
  <tbody>
    @foreach($transaksi as $key => $item)
      <tr>
        <td>{{ $key + 1 }}</td>
        <td>{{ $item->id_order }}</td>
        <td>{{ $item->produk }}</td>
        <td>{{ $item->ukuran }}</td>
        <td>
          @php
            $date = Carbon\Carbon::parse($item->tanggal_masuk)->locale('id');
            $date->settings(['formatFunction' => 'translatedFormat']);
          @endphp
          {{ $date->format('d-m-Y'); }}
        </td>
        <td>{{ $item->status }}</td>
        <td>{{ $item->status_return }}</td>
        <td>{{ $item->id_return }}</td>
      </tr>
    @endforeach
  </tbody>
</table>