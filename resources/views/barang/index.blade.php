@extends("master")

@section('title', 'List barang')

@section("content")
{{-- @parent = Manggil Bapaknya/Ibunya --}}
@parent
<a href="{{ url("/master/barang/tambah") }}">Tambah</a>
<br>
<table border="1">
    <tr>
        <th>ID Barang</th><th>Nama Barang</th>
        <th>Harga</th><th>Stok</th><th>Action</th>
    </tr>
    {{-- Ini untuk check data yang dikasih kosong apa tidak --}}
    @if (count($data) <= 0)
    <tr><td colspan="5">Tidak ada data barang</td></tr>
    @else
    @foreach ($data as $d)
    <tr><td>{{ $d["id"] }}</td><td>{{ $d["nama"] }}</td>
        <td>{{ $d["harga"] }}</td><td>{{ $d["stok"] }}</td>
        {{-- Ini untuk link ke halaman edit --}}
        <td>
            <a href="{{ url("/master/barang/".$d["id"]) }}">Edit</a>
            <form method="POST" action="{{ url("/master/barang/".$d["id"]) }}">
                @csrf
                @method("DELETE")
                <button type="submit">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
    @endif
</table>
@endsection
