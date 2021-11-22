@extends("master")

@section("title", "Ubah Barang")

@section("content")
{{-- Ini untuk memberikan feedback --}}
<b><i>{{ $msg ?? "" }}</i></b> <br/>

<form method="POST">
    {{-- Fungsinya untuk memberi unique code untuk setiap form --}}
    @csrf
    @method("PATCH")
    ID Barang <input type="text" name="id" value="{{ $d["id"] }}" required> <br>
    Nama Barang <input type="text" value="{{ $d["nama"] }}" name="nama" required> <br>
    Harga <input type="number" min="1000" value="{{ $d["harga"] }}" name="harga" required> <br>
    Stok <input type="number" name="stok" value="{{ $d["stok"] }}" required> <br>
    <button type="submit">Update</button>
</form>
@endsection
