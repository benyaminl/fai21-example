@extends("master")

@section("title", "List Transaksi")

@section("content")
<a href="{{ url("/master/transaksi/tambah") }}">(+) Buat Transaksi</a> <br/><br/>
<table border=1>
    <tr>
        <th>ID</th><th>Tanggal</th>
        <th>Nama Pelanggan</th><th>Voucher</th>
        <th>Diskon</th><th>Total</th>
    </tr>
    @if (count($data) > 0)
        @foreach ($data as $d)
        <tr>
            <th>{{ $d->id_trans }}</th>
            <th>{{ $d->tanggal_transaksi }}</th>
            <th>{{ $d->nama_pelanggan }}</th>
            <th>{{ $d->voucher }}</th>
            <th>{{ $d->total_diskon }}</th>
            <th>{{ $d->total_akhir }}</th>
        </tr>
        @endforeach
    @else
        <tr><td colspan="6">Tidak ada data ditemukan</td></tr>
    @endif

</table>
@endsection
