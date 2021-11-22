@extends("master")

@section("title", "Tambah Voucher")

@section("content")
<form method="POST">
@csrf
Nama Voucher <input type="text" name="nama" value="{{ old('nama') }}"><br/>
Tipe
<input type="radio" name="tipe" value="rupiah"
{{ (old('tipe') == 'rupiah') ? "checked='checked'" : "" }}> Rupiah
<input type="radio" name="tipe" value="persen"
{{ (old('tipe') == 'persen') ? "checked='checked'" : "" }}> Persen
<br/>
Jumlah <input type="number" name="jumlah" value="{{ old('jumlah') }}">
<br/>
<button type="submit">Tambah</button>
</form>
@endsection
