@extends("master")

@section("title", "List Voucher")

@section("content")
<a href="{{ url("/master/voucher/tambah") }}">Tambah</a> <br/>
<table border=1>
@if (count($data) <= 0)
<tr><td>Tidak ada data</td></tr>
@else
<tr><th>ID</th><th>Nama</th><th>Tipe</th>
    <th>Jumlah</th><th>Aksi</th></tr>
    @foreach ($data as $d)
    <tr>
        <td>{{ $d->id_voucher }}</td><td>{{ $d->nama_voucher }}</td>
        <td>{{ $d->tipe_voucher }}</td><td>{{ $d->jumlah_diskon }}</td>
        <td>
            <a href="{{ url("/master/voucher/".$d->id_voucher) }}">Edit</a>
            <a href="{{ url("/master/voucher/".$d->id_voucher."/delete") }}">Delete</a>
        </td>
    </tr>
    @endforeach
@endif
</table>
@endsection
