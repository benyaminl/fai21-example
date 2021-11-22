@extends("master")

@section("title", "Tambah Barang")

@section("content")
{{-- Ini untuk memberikan feedback --}}
<b><i>{{ $msg ?? "" }}</i></b> <br/>

<form method="POST">
    {{-- Fungsinya untuk memberi unique code untuk setiap form --}}
    @csrf
    ID Barang <input type="text" name="id" required> <br>
    Nama Barang <input type="text" name="nama" required> <br>
    Harga <input type="number" min="1000" name="harga" required> <br>
    Stok <input type="number" name="stok" required> <br>
    <button type="submit">Tambah</button>
</form>
@endsection
