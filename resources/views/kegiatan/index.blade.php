<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kegiatan</title>
    <link rel="shortcut icon" href="{{ asset('image/logo-satria.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Montserrat', sans-serif;
            background-color: #f9f9f9;
            color: #333;
        }

        header {
            position: fixed;
            top: 20px;
            left: 50%;
            height: 2.5rem;
            transform: translateX(-50%);
            width: 90%;
            background: rgba(255, 255, 255, 0.8);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 25px;
            padding: 10px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .logo img {
            height: 40px;
        }

        .menu a {
            margin: 0 10px;
            text-decoration: none;
            color: #333;
            font-weight: 600;
            transition: color 0.3s ease;
        }

        .menu a:hover {
            color: #ff6f61;
        }

        .profile img {
            height: 40px;
            width: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        h1 {
            margin-top: 120px;
            text-align: center;
            font-size: 2.5rem;
            color: whitesmoke;
        }

        .content {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
            margin-block: 8rem
        }

        .card-container {
            background-color: #fff;
            border-radius: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            width: 300px;
            transition: transform 0.3s ease;
        }

        .card-container:hover {
            transform: translateY(-10px);
        }

        .card img {
            width: 100%;
            height: 180px;
            object-fit: cover;
        }

        .card-judul {
            padding: 15px;
        }

        .card-judul h2 {
            font-size: 1.2rem;
            margin: 5px 0;
            color: #333;
        }

        .subscription-section {
            background-color: #ff6f61;
            color: white;
            text-align: center;
            padding: 20px 20px;
            margin-top: 30px;
            border-radius: 20px;
            width: 80%;
            margin-left: auto;
            margin-right: auto;
        }

        .subscription-section h1 {
            color: white;
            margin-bottom: 15px;
        }

        .subscription-form input,
        .subscription-form select,
        .subscription-form button {
            padding: 10px;
            margin: 10px;
            border: none;
            border-radius: 5px;
            font-size: 1rem;
        }

        .subscription-form button {
            background-color: #333;
            color: white;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .subscription-form button:hover {
            background-color: #222;
        }

        .footer {
            text-align: center;
            padding: 20px;
            background-color: #333;
            color: white;
            margin-top: 20px;
        }

        .footer a {
            color: white;
            text-decoration: none;
            margin: 0 10px;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        .top-header{
            background-color: #ff6f61;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 18rem;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src={{ asset('image/logo-satria.png') }} alt="Logo"> <!-- Ganti dengan URL atau path logo -->
        </div>

        <div class="menu">
            <a href="{{ route('kegiatan.index') }}">Relawan</a>
            <a href="{{ route('donasi.index') }}">Donasi</a>
            <a href="{{ route('organisasi.index') }}">Organisasi</a>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
            
            
        </div>
        <a href="{{ route('profil_relawan.show', $profil->user_id) }}">
            <div class="profile">
                <img src="{{ asset('storage/'. $profil->foto) }}" alt="Profile"> <!-- Ganti dengan URL atau path gambar profil -->
            </div>
        </a>
        
    </header>
    <div class="top-header">
        <h1>Cari Kegiatan Relawan</h1>
    </div>
    
    
    
    <div class="content">
        @foreach ($kegiatan as $k)
            <div class="card-container">
                <a href="{{ route('kegiatan.show', $k->id) }}">
                    <div class="card">
                        <img src="{{ $k->foto }}" alt="">
                        <div class="card-judul">
                            <h2>{{ $k->judul }}</h2>
                            <h2>{{ $k->lokasi }}</h2>
                            <h2>{{ $k->deskripsi }}</h2>
                        </div>
                    </div>
                </a>
            </div>
        @endforeach
    </div>

    <div class="subscription-section">
        <h1>Jadilah Inspirasi!</h1>
        <p>Kami akan mengirimkan Anda berita, kampanye nasional dan internasional, serta cara-cara menarik untuk berkontribusi.</p>
        <form class="subscription-form" action="subscribe.php" method="POST">
            <input type="text" name="first_name" placeholder="Nama" required>
            <input type="text" name="last_name" placeholder="Nama belakang" required>
            <input type="email" name="email" placeholder="Email" required>
            <select name="subscription_type" required>
                <option value="">Langganan</option>
                <option value="daily">Harian</option>
                <option value="weekly">Mingguan</option>
                <option value="monthly">Bulanan</option>
            </select>
            <button type="submit">Langganan</button>
        </form>
    </div>

    <div class="footer">
        <div class="social-icons">
            <a href="#">&#x1F426; Twitter</a>
            <a href="#">&#x1F4F1; Instagram</a>
            <a href="#">&#x1F4E7; Email</a>
        </div>
        <p>Volunteer | Donate | Find Causes</p>
        <p>Campaigns | Offers | Create an Offer</p>
        <p>For Business | Resources | Contact Us</p>
    </div>
</body>
</html>
