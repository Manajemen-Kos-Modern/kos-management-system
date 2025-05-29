<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Login</title>
    @vite(['resources/css/login.css'])
</head>

<body>
    <div class="login-container">
        <div class="login-left">
            <h1>🏠 Selamat Datang di Kost Kita </h1>
            <h2>Semua kebutuhan kost-mu,<br>cukup dalam satu genggaman</h2>
            <p><span class="dot"></span><span class="dot"></span><span class="dot"></span> Banyak penyewa telah
                bergabung – sekarang giliranmu!</p>
        </div>
        <div class="login-right">
            <h2>Sign in</h2>
            <form method="POST" action="{{ route('login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email address" required>
                <input type="password" name="password" placeholder="Password" required>
                <div class="actions">
                    <a href="{{ route('password.request') }}">Forgot password?</a>
                    <button type="submit">Sign in</button>
                </div>
            </form>
            <div class="register-option">
                New user? <a href="{{ route('register') }}">Create an account</a>
            </div>
        </div>
    </div>
</body>

</html>