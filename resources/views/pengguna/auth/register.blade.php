{{-- filepath: c:\Users\Shaun\Desktop\laravel12Test\laravel12Test\resources\views\auth\register.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    @vite(['resources/css/register.css', 'resources/js/register.js'])
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h1>Cuboid</h1>
            <h2>Rumah Terbaik adalah di Sini, Bersama Kalian Semua! Terima kasih atas kepercayaan Anda.</h2>

        </div>
        <div class="right-section">
            <h2>Create an account</h2>
            <p>Already have an account? <a href="{{ route('pengguna.login') }}">Sign in</a></p>
            <form method="POST" action="{{ route('pengguna.register.post') }}">
                @csrf
                <input type="text" name="nama" placeholder="Full Name" value="{{ old('nama') }}" required>
                <input type="email" name="email" placeholder="Email address" value="{{ old('email') }}" required>
                <input type="password" name="password" placeholder="Password" required>
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
                <input type="text" name="no_hp" placeholder="Phone Number" value="{{ old('no_hp') }}">
                <select name="gender">
                    <option value="">-- Select Gender --</option>
                    <option value="L" {{ old('gender') == 'L' ? 'selected' : '' }}>Male</option>
                    <option value="P" {{ old('gender') == 'P' ? 'selected' : '' }}>Female</option>
                </select>
                <button type="submit">Sign Up</button>
            </form>

        </div>
    </div>
</body>

</html>