@extends("master")
{{-- Ini adalah file copas dari Tambah --}}
@section("title", "Hapus Voucher")

@section("content")
<form method="POST" action="{{ url("/master/voucher/". $d->id) }}">
@csrf @method("DELETE")
Nama Voucher <input type="text" name="nama"
value="{{ $d->nama_voucher }}" disabled><br/>
Tipe
<input type="radio" name="tipe" value="rupiah"
{{ (old('tipe') == 'rupiah' || $d->tipe_voucher == 2)
    ? "checked='checked'" : "" }} disabled> Rupiah
<input type="radio" name="tipe" value="persen"
{{ (old('tipe') == 'persen' || $d->tipe_voucher == 1)
    ? "checked='checked'" : "" }} disabled> Persen
<br/>
Jumlah <input type="number" name="jumlah"
value="{{ old('jumlah') ?? $d->jumlah_diskon }}" disabled>
<br/>
<button type="submit">Delete</button>
<a href="{{ url("/master/voucher") }}">Cancel</a>
</form>
@endsection
