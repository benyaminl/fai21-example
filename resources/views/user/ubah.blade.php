@extends("master")

@section("title", "Ubah User")

@section("content")
{{-- Ini untuk memberikan feedback --}}
<b><i>{{ $msg ?? "" }}</i></b> <br/>

<form method="POST">
    {{-- Fungsinya untuk memberi unique code untuk setiap form --}}
    @csrf
    @method("PATCH")
    Username <input type="text" name="user"
        value="{{ old('user') ?? $d->user }}" required> <br>
    Password <input type="text" name="pass"> <br>
    <small>Silahkan kosongi password jika tidak update password!</small>
    <button type="submit">Update</button>
</form>
@endsection
