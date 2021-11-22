@extends("master")

@section("title", "Tambah User")

@section("content")
{{-- Ini untuk memberikan feedback --}}
<b><i>{{ $msg ?? "" }}</i></b> <br/>

<form method="POST">
    {{-- Fungsinya untuk memberi unique code untuk setiap form --}}
    @csrf
    Username <input type="text" name="user" required> <br>
    Password <input type="text" name="pass" required> <br>
    <button type="submit">Tambah</button>
</form>
@endsection
