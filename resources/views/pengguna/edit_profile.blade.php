<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    @vite(['resources/css/edit-profile.css', 'resources/js/edit-profile.js'])
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

        <!-- Profile Container -->
        <div class="main-content">
            <div class="profile-container">
                <h2>Edit Profile</h2>
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <!-- Profile Photo -->
                    <div class="profile-photo-wrapper">
                        <label for="foto_profile" style="cursor: pointer;">
                            <img id="profilePreview"
                                src="{{ $user->foto_profile ? asset('storage/profile_photos/' . $user->foto_profile) : asset('images/default-profile.png') }}"
                                alt="Profile Photo">
                        </label>
                        <input type="file" id="foto_profile" name="foto_profile" accept="image/*"
                            onchange="previewProfilePhoto(this)">
                    </div>

                    <!-- Form Fields -->
                    <div class="form-group">
                        <label for="nama">Full Name</label>
                        <input type="text" id="nama" name="nama" value="{{ $user->nama }}" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" id="email" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group">
                        <label for="no_hp">Mobile Phone Number</label>
                        <input type="text" id="no_hp" name="no_hp" value="{{ $user->no_hp }}" required>
                    </div>
                    <div class="form-group">
                        <label for="gender">Gender</label>
                        <select id="gender" name="gender" required>
                            <option value="L" {{ $user->gender == 'L' ? 'selected' : '' }}>Male</option>
                            <option value="P" {{ $user->gender == 'P' ? 'selected' : '' }}>Female</option>
                        </select>
                    </div>

                    <!-- Save Button -->
                    <div class="form-actions">
                        <button type="submit" class="btn btn-save">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>