<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>
</head>
<body>
    @if (session()->has("success"))
    {{-- Ini flash Session --}}
    <div class="success">
        <i><b>{{ session()->get("success") }}</b></i>
    </div>
    @endif
    @if (session()->has("error"))
    {{-- Ini flash Session --}}
    <div class="error">
        <i><b>{{ session()->get("error") }}</b></i>
    </div>
    @endif

    <form method="post">
        @csrf
        User <input type="text" name="user" id="user"> <br/>
        Pass <input type="password" name="pass" id="user"> <br/>
        <button type="submit">Login</button>
    </form>
</body>
</html>
