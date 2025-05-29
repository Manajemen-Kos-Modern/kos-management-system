<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    @vite(['resources/css/register.css'])
</head>
<body>
    <div class="register-container">
        <div class="register-left">
            <h1>📋 Cuboid</h1>
            <h2>Manajemen Kost</h2>
            <p>
                <span class="dot"></span><span class="dot"></span><span class="dot"></span>
                3k+ people joined us, now it’s your turn
            </p>
        </div>
        <div class="register-right">
            <h2>Create an account</h2>
            <div class="login-link">
                Already have an account? <a href="{{ route('login') }}">Sign in</a>
            </div>
           <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
    @csrf

    <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>

    <input type="text" name="nama" placeholder="Nama Lengkap" value="{{ old('nama') }}" required>

    <input type="text" name="no_hp" placeholder="No HP" value="{{ old('no_hp') }}" required>

    <select name="gender" required>
        <option value="">Pilih Gender</option>
        <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Laki-laki</option>
        <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Perempuan</option>
    </select>

    <!-- <select name="role" required>
        <option value="">Pilih Role</option>
        <option value="penyewa" {{ old('role') == 'penyewa' ? 'selected' : '' }}>Penyewa</option>
        <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
    </select> -->
   <input type="hidden" name="role" value="penyewa">

    <input type="file" name="foto_profile" accept="image/*">

    <input type="password" name="password" placeholder="Password" required>
    <input type="password" name="password_confirmation" placeholder="Confirm Password" required>

    <button type="submit">Sign Up</button>
</form>
        </div>
    </div>
</body>
</html>
