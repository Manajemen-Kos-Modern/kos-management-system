<?php
// Contoh data notifikasi statis
$notifications = [
    "today" => [
        "Welcome to our boarding house. Hope you enjoy your stay.",
    ],
    "last_week" => [
        "Welcome to our boarding house. Hope you enjoy your stay.",
        "Welcome to our boarding house. Hope you enjoy your stay.",
    ],
];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Notifikasi</title>
    @vite(['resources/css/notification.css', 'resources/js/notification.js'])
</head>

<body>
    <!-- Sidebar -->
    <aside class="sidebar">
        <h2 class="menu-title">Menu</h2>
        <ul class="menu-list">
            <li>
                <span>🏠</span>
                <a href="">Dashboard</a>
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
    <div class="main-content">
        <div class="header">Notifikasi</div>

        <div class="section">
            <h3>Today</h3>
            <?php foreach ($notifications['today'] as $note): ?>
            <div class="notification"><?= htmlspecialchars($note) ?></div>
            <?php endforeach; ?>
        </div>

        <div class="section">
            <h3>Last Week</h3>
            <?php foreach ($notifications['last_week'] as $note): ?>
            <div class="notification"><?= htmlspecialchars($note) ?></div>
            <?php endforeach; ?>
        </div>
    </div>

    <img src="https://cdn-icons-png.flaticon.com/512/1828/1828919.png" class="corner-icon" alt="decoration" />
    <script src="script.js"></script>
</body>

</html>