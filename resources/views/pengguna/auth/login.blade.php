<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    @vite(['resources/css/login.css', 'resources/js/login.js'])
</head>

<body>
    <div class="container">
        <div class="left-section">
            <h1>Welcome in Kost</h1>
            <h2>Rumah Terbaik adalah di Sini, Bersama Kalian Semua! Terima kasih atas kepercayaan Anda.</h2>
        </div>
        <div class="right-section">
            <h2>Sign in</h2>
            <p>New user? <a href="{{ route('pengguna.register') }}">Create an account</a></p> <!-- Link ke register -->
            <form method="POST" action="{{ route('pengguna.login.post') }}">
                @csrf
                <input type="email" name="email" placeholder="Email address" required>
                <input type="password" name="password" placeholder="Password" required>
                <a href="#" class="forgot-password">Forgot password?</a>
                <button type="submit">Sign In</button>
            </form>

        </div>
    </div>
</body>

</html>