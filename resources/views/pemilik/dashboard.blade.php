<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard Pemilik Kost</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> <!-- Pastikan file CSS tersedia -->
</head>

<body>
    <div class="container">
        {{-- Menampilkan pesan sukses jika ada --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <h1>Dashboard Pemilik Kost</h1>
        <p>Selamat datang, Pemilik Kost!</p>

        <a href="/logout" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display:none;">
            @csrf
        </form>

        {{-- Tambahkan ini untuk debugging --}}
        {{ dd(session()->all()) }}
    </div>
</body>

</html>