<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome</title>
    @vite(['resources/css/welcome.css'])
</head>
<body>
    <div class="main-container">
        <div class="main-card">
            <div class="main-card-img-wrapper">
                <img src="{{ asset('images/image1.png') }}" alt="Landing Page Image" class="main-card-img">
            </div>
            <div class="main-card-info">
                <h2>MANAGEMENT KOST</h2>
                <p>Kelola Kost-mu Mudah dan Cepat<br>Sewa, Atur, dan Laporan Kost hanya di ujung jari</p>
                <a href="{{ route('login') }}" class="main-card-btn">Masuk Sekarang</a>
            </div>
        </div>
    </div>
</body>
</html>
