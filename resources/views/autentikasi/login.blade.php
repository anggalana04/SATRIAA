<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Page</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('image/bg_login.jpg');
            background-size: cover; /* Cover the entire viewport */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .login-box {
            width: 400px; /* Fixed width for the box */
            padding: 30px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2); /* Semi-transparent white */
            backdrop-filter: blur(10px); /* Blurred glass effect */
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2); /* Subtle shadow */
            text-align: center;
        }

        .login-box img {
            width: 100px; /* Adjust logo size */
            margin-bottom: 15px;
        }

        .login-box h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .login-box input {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.8);
            font-size: 16px;
        }

        .login-box input:focus {
            outline: none;
            border: 2px solid #007BFF;
        }

        .login-box button {
            width: 100%;
            padding: 10px;
            background-color: #007BFF;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 18px;
            cursor: pointer;
            margin: 15px 0;
        }

        .login-box button:hover {
            background-color: #0056b3;
        }

        .login-box a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        .login-box a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="login-box">
        <img src="image/logo-satria.png" alt="Logo">
        <h1>Sign in to SATRIA</h1>
        <form action="{{ route('autentikasi') }}" method="POST">
            @csrf
            <input type="email" placeholder="Email address" required name="email" id="email">
            <input type="password" placeholder="Password" required name="password" id="password">
            <a href="#">Forgot password?</a>
            <button type="submit">Sign in</button>
        </form>
        <br><br>
        <a href="{{ route('user.create') }}">Belum Punya Akun? Buat Akun</a>
    </div>
</body>
</html>
