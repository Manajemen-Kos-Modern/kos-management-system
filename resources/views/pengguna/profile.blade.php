<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
    @vite(['resources/css/profile.css', 'resources/js/profile.js'])
</head>

<body>
    <div class="flex">
        <!-- Sidebar -->
        <aside class="sidebar">
            <h2 class="menu-title"></h2>
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
        <div class="main-content">
            <div class="profile-container">
                <div class="profile-header">
                    <span class="profile-title">Profile</span>
                </div>
                <div class="profile-photo">
                    <img src="{{ $user->foto_profile ? asset('storage/profile_photos/' . $user->foto_profile) : asset('images/default-profile.png') }}"
                        alt="Profile Photo">
                </div>
                <div class="profile-info">
                    <div class="form-group">
                        <label for="nama">Full Name</label>
                        <span id="nama">{{ $user->nama }}</span>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <span id="email">{{ $user->email }}</span>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Mobile Phone Number</label>
                        <span id="no_hp">{{ $user->no_hp }}</span>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <span id="gender">{{ $user->gender == 'L' ? 'Male' : 'Female' }}</span>
                    </div>
                </div>
                <div class="profile-actions">
                    <!-- <a href="#" class="btn btn-back">Back</a> -->
                    <a href="{{ route('profile.edit') }}" class="btn btn-edit">Edit Profile</a>
                </div>
            </div>
        </div>

    </div>
</body>


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