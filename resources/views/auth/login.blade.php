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
            <h1>📋 Cuboid</h1>
            <h2>One tool for your<br>whole team needs</h2>
            <p><span class="dot"></span><span class="dot"></span><span class="dot"></span> 3k+ people joined us, now it’s your turn</p>
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
