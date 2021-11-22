<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') | POS Sederhana</title>
    <link rel="stylesheet" href="{{ url("/css/main.css") }}">
</head>
<body>
<nav>
    <a href="{{ url("/master/barang") }}">Master Barang</a>
</nav>
<h1>@yield('title')</h1>
User : {{ $user }} <br/>
@if (session()->has("success"))
{{-- Ini flash Session --}}
<div class="success">
    <i><b>{{ session()->get("success") }}</b></i>
</div>
@endif

@if ($errors->any())
    <div class="error">
    @foreach ($errors->all() as $e)
        <b><i>{{ $e }}</i></b> <br/>
    @endforeach
    </div>
@endif
{{-- Ini adalah bagian Konten! --}}
@section("content")
Silahkan di ubah!
@show
</body>
</html>
