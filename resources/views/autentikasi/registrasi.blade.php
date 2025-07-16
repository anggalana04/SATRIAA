<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi User</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            background-image: url('{{ asset('image/bg_login.jpg') }}');
            background-size: cover; /* Cover the entire viewport */
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh; /* Full height */
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0;
        }

        .registration-box {
            width: 400px;
            padding: 30px;
            border-radius: 20px;
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            box-shadow: 0px 4px 20px rgba(0, 0, 0, 0.2);
            text-align: center;
        }

        .registration-box h1 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #333;
        }

        .registration-box input,
        .registration-box select {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: none;
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.8);
            font-size: 16px;
        }

        .registration-box input:focus,
        .registration-box select:focus {
            outline: none;
            border: 2px solid #007BFF;
        }

        .registration-box button {
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

        .registration-box button:hover {
            background-color: #0056b3;
        }

        .registration-box a {
            text-decoration: none;
            color: #007BFF;
            font-size: 14px;
        }

        .registration-box a:hover {
            text-decoration: underline;
        }

        .error-message {
            background: rgba(255, 0, 0, 0.1);
            padding: 10px;
            border-radius: 5px;
            color: #d9534f;
            margin-bottom: 20px;
        }

    </style>
</head>
<body>
    <div class="registration-box">
        <h1>Form Registrasi User</h1>

        <!-- Error messages -->
        @if ($errors->any())
            <div class="error-message">
                <h3 class="font-bold">Kesalahan:</h3>
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('user.store') }}" method="POST">
            @csrf
            <!-- Username -->
            <input type="text" name="username" placeholder="Masukkan username" value="{{ old('username') }}" required>

            <!-- Email -->
            <input type="email" name="email" placeholder="Masukkan email" value="{{ old('email') }}" required>

            <!-- Password -->
            <input type="password" name="password" placeholder="Masukkan password" required>

            <!-- Jenis -->
            <select name="jenis" required>
                <option value="" disabled selected>Pilih jenis user</option>
                <option value="individu" {{ old('jenis') == 'individu' ? 'selected' : '' }}>Individu</option>
                <option value="organisasi" {{ old('jenis') == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                <option value="admin" {{ old('jenis') == 'admin' ? 'selected' : '' }}>Admin</option>
            </select>

            <!-- Submit Button -->
            <button type="submit">Jadi Satria !</button>
        </form>

        <br>
        <a href="{{ route('login') }}">Sudah punya akun? Login</a>
    </div>
</body>
</html>
