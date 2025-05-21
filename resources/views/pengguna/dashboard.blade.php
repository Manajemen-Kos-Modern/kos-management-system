<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Pengguna</title>
    @vite(['resources/css/pengguna.css', 'resources/js/pengguna.js'])
</head>

<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="menu-title">Menu</h2>
            <ul class="menu-list">
                <li>
                    <span>🏠</span>
                    <a href="#">Dashboard</a>
                </li>
                <li>
                    <span>📋</span>
                    <a href="#">Pemesanan</a>
                </li>
                <li>
                    <span>💳</span>
                    <a href="#">Riwayat Pembayaran</a>
                </li>
                <li>
                    <span>📜</span>
                    <a href="#">Informasi Pembayaran & Kontrak</a>
                </li>
                <li>
                    <span>📢</span>
                    <a href="#">Laporan Keluhan</a>
                </li>
                <li>
                    <span>🔔</span>
                    <a href="{{ route('pengguna.notification') }}">Notifikasi</a>
                </li>
                <li>
                    <span>👤</span>
                    <a href="{{ route('profile.show') }}">Profil</a>
                </li>
                <li>
                    <span>🚪</span>
                    <a href="#"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                    <form id="logout-form" method="POST" action="{{ route('logout') }}" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </aside>

        <!-- Main Content -->
        <main class="main-content">
            <div class="welcome-message">
                <h1>Selamat Datang, {{ Auth::user()->nama }}!</h1>
                <p>Selamat pagi, apa yang ingin Anda cari hari ini?</p>
            </div>

            <div class="search-bar">
                <input type="text" placeholder="Tuliskan tipe kos yang Anda cari">
            </div>


        </main>
    </div>

    <!-- Chatbot Button -->
    <div id="chatbot-toggle" class="chatbot-toggle">💬</div>

    <!-- Chatbot Container -->
    <div id="chatbot-container" class="chatbot-container">
        <div id="chatbot-header" class="chatbot-header">
            <h2>Chatbot</h2>
            <button id="chatbot-close">✖</button>
        </div>
        <div id="chatbot-messages" class="chatbot-messages">
            <div class="bot-message">Halo! Ada yang bisa saya bantu?</div>
        </div>
        <div id="chatbot-input-container" class="chatbot-input-container">
            <form id="chatbot-form">
                <input id="chatbot-input" type="text" placeholder="Ketik pesan...">
                <button id="chatbot-send" type="submit">Kirim</button>
            </form>
        </div>
    </div>
</body>

</html>