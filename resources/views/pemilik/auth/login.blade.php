<!DOCTYPE html>
<html lang="en" class="h-full bg-[#4CAF50]">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Pemilik</title>

    <!-- CSS Langsung -->
    <style>
        /* Background and full height */
        html,
        body {
            height: 100%;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            background-color: #4CAF50;
            font-family: 'Arial', sans-serif;
        }

        /* Container */
        .container {
            display: flex;
            width: 90%;
            max-width: 1000px;
            background-color: #ffffff;
            border-radius: 1rem;
            overflow: hidden;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        /* Left Section */
        .left-section {
            flex: 1;
            background-color: #4CAF50;
            color: #ffffff;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .left-section h1 {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 1rem;
        }

        .left-section p {
            font-size: 1.2rem;
            margin-top: 1rem;
            line-height: 1.5;
        }

        /* Right Section */
        .right-section {
            flex: 1;
            padding: 3rem;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .right-section h2 {
            font-size: 2rem;
            font-weight: bold;
            margin-bottom: 1rem;
            color: #333333;
        }

        .right-section p {
            font-size: 1rem;
            margin-bottom: 1.5rem;
            color: #555555;
        }

        .right-section p a {
            color: #4CAF50;
            text-decoration: none;
            font-weight: bold;
        }

        .right-section form {
            display: flex;
            flex-direction: column;
        }

        .input-field {
            width: 100%;
            padding: 0.75rem;
            margin-bottom: 1rem;
            border: 1px solid #d1d5db;
            border-radius: 0.375rem;
            font-size: 1rem;
            background-color: #f9f9f9;
            transition: border-color 0.3s ease;
        }

        .input-field:focus {
            border-color: #4CAF50;
            outline: none;
        }

        .submit-button {
            background-color: #388E3C;
            color: #ffffff;
            padding: 0.75rem;
            border: none;
            border-radius: 0.375rem;
            font-size: 1rem;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .submit-button:hover {
            background-color: #66BB6A;
        }

        .privacy-text {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 1rem;
            text-align: center;
        }

        .privacy-text a {
            color: #4CAF50;
            text-decoration: none;
        }

        .forgot-password {
            font-size: 0.875rem;
            color: #4CAF50;
            text-decoration: none;
            margin-bottom: 1rem;
            display: inline-block;
        }

        .forgot-password:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <!-- Left Section -->
        <div class="left-section">
            <h1>Welcome Pemilik</h1>
            <p>Access your property management tools and stay in control of your business.</p>
        </div>

        <!-- Right Section -->
        <div class="right-section">
            <h2>Sign in</h2>
            <p>New user? <a href="#">Create an account</a></p>
            <form method="POST" action="{{ route('pemilik.login') }}">
                @csrf
                <input type="email" name="email" placeholder="Email address" required class="input-field">
                <input type="password" name="password" placeholder="Password" required class="input-field">
                <a href="#" class="forgot-password">Forgot password?</a>
                <button type="submit" class="submit-button">Sign In</button>
            </form>
        </div>
    </div>
</body>

</html>