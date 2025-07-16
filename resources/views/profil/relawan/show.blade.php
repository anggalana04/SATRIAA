<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&amp;display=swap" rel="stylesheet"/>
    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }
        header {
            position: fixed;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 100%;
            background: rgba(255, 255, 255, 0.9);
            backdrop-filter: blur(10px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 1000;
        }

        .logo img {
            height: 40px;
        }

        .menu a {
            margin: 0 15px;
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

    </style>
</head>
<body class="bg-gray-100">
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

    <main class="container mx-auto mt-10 px-6">
        <h1 class="text-4xl font-bold text-center mb-10">DASHBOARD</h1>
        <div class="flex flex-col md:flex-row">
            <aside class="w-full md:w-1/3 mb-10 md:mb-0">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="text-center mb-6">
                        <img alt="Profile Picture" class="w-24 h-24 rounded-full mx-auto" height="100" src="{{ asset('storage/'.$profil->foto) }}" width="100"/>
                        <h2 class="text-xl font-bold mt-4">{{ $profil->nama_lengkap }}</h2>
                        <p class="text-gray-600">{{ $profil->keahlian }}</p>
                        <div class="flex justify-center mt-2">
                            <!-- Assuming you want to display rating stars based on the rating -->
                            @for($i = 0; $i < 5; $i++)
                                <i class="fas fa-star {{ $i < $profil->rating ? 'text-red-500' : 'text-gray-400' }}"></i>
                            @endfor
                        </div>
                        <p class="text-gray-600 mt-2">{{ $profil->pengalaman }} Aktivitas</p>
                    </div>
                    <div class="text-center">
                        <p class="text-gray-600">Total Jam</p>
                        <p class="text-xl font-bold">{{ $profil->total_jam }} JAM</p>
                        <p class="text-gray-600 mt-4">Total Donasi</p>
                        <p class="text-xl font-bold">Rp. {{ number_format($profil->total_donasi, 2) }}</p>
                    </div>
                </div>
            </aside>

            <section class="w-full md:w-2/3">
                <div class="bg-white p-6 rounded-lg shadow-md">
                    <div class="flex border-b mb-6">
                        <button class="w-1/2 py-2 text-center font-bold border-b-2 border-black">KEGIATAN KU</button>
                        <button class="w-1/2 py-2 text-center font-bold text-gray-500">FOTO KU</button>
                    </div>
                    
                </div>
            </section>
        </div>
    </main>
</body>
</html>
