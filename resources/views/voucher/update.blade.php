@extends("master")
{{-- Ini adalah file copas dari Tambah --}}
@section("title", "Update Voucher")

@section("content")
<form method="POST">
@csrf @method("PATCH")
Nama Voucher <input type="text" name="nama"
value="{{ old('nama') ?? $d->nama_voucher }}"><br/>
Tipe
<input type="radio" name="tipe" value="rupiah"
{{ (old('tipe') == 'rupiah' || $d->tipe_voucher == 2)
    ? "checked='checked'" : "" }}> Rupiah
<input type="radio" name="tipe" value="persen"
{{ (old('tipe') == 'persen' || $d->tipe_voucher == 1)
    ? "checked='checked'" : "" }}> Persen
<br/>
Jumlah <input type="number" name="jumlah"
value="{{ old('jumlah') ?? $d->jumlah_diskon }}">
<br/>
<button type="submit">Update</button>
</form>
@endsection
