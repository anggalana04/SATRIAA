<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $donasi->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
    <style>
        body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
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
        .card {
            display: flex;
            flex-direction: row;
            background-color: #fff;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            overflow: hidden;
            width: 100%;
            max-width: 800px;
        }
        .card-image {
            width: 40%;
            height: auto;
            object-fit: cover;
        }
        .card-content {
            padding: 20px;
            width: 60%;
        }
        .button {
            background-color: #ff4d4d;
            color: #fff;
            border: none;
            padding: 10px 20px;
            font-size: 16px;
            border-radius: 5px;
            text-decoration: none;
            text-align: center;
            display: inline-block;
            margin-top: 20px;
            cursor: pointer;
        }
        .button:hover {
            background-color: #e63939;
        }
        .section {
            margin: 20px 0;
        }
        .section h3 {
            margin-bottom: 5px;
        }
        .progress-bar {
            background-color: #e9ecef;
            border-radius: 5px;
            height: 20px;
            width: 100%;
            margin-bottom: 10px;
        }
        .progress-bar-filled {
            background-color: #28a745;
            height: 100%;
            width: 0%; /* default percentage */
            border-radius: 5px;
            text-align: center;
            color: #fff;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo">
            <img src={{ asset('image/logo-satria.png') }} alt="Logo">
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
    </header>
    <main class="container mx-auto p-4 mt-16">
        <h1 class="text-3xl font-bold mb-2">{{ $donasi->nama }}</h1>
        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt"></i> {{ $donasi->lokasi }}</p>

        <div class="card">
            <img src="{{ asset('storage/'.$donasi->foto) }}" alt="Donasi Image" class="card-image">
            <div class="card-content">
                <h2 class="text-xl font-bold mb-2">Bantu dengan Donasi</h2>
                <p class="text-gray-600 mb-4">Bantu {{ $donasi->deskripsi }} dengan target donasi sebesar {{ number_format($donasi->target_donasi, 0, ',', '.') }}.</p>

                <div class="section">
                    <h3 class="text-lg font-bold">Dana Terkumpul</h3>
                    <div class="progress-bar">
                        <div class="progress-bar-filled" style="width: {{ $donasi->persentase_dana }}%;">{{ $donasi->persentase_dana }}%</div>
                    </div>
                    <p>{{ number_format($donasi->jumlah_donasi, 0, ',', '.') }} terkumpul dari {{ number_format($donasi->target_donasi, 0, ',', '.') }}</p>
                </div>

                <!-- Remove this section to hide the status update dropdown -->
                <!--
                <div class="section">
                    <h3 class="text-lg font-bold">Ubah Status Donasi</h3>
                    <select name="status" class="status-dropdown" onchange="updateStatus(this, {{ $donasi->id }})">
                        <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                        <option value="aktif" {{ $donasi->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                        <option value="selesai" {{ $donasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                    </select>
                </div>
                -->
            </div>
            <a href="{{ route('donasi.transfer', $donasi->id) }}" class="button">Donasi</a>
        </div>
    </main>

    <footer class="bg-gray-800 text-white p-8 mt-8">
        <div class="container mx-auto flex flex-col md:flex-row justify-between items-center">
            <div class="flex flex-col md:flex-row items-center gap-4">
                <img src="https://storage.googleapis.com/a1aa/image/lHoYhBG7QkYeMq34HllNAB9hZ44fHNaqTn9WE51FipxV5e4nA.jpg" alt="Logo" class="h-12">
                <div class="flex space-x-4">
                    <a href="#" class="text-white"><i class="fab fa-facebook"></i> Follow</a>
                    <a href="#" class="text-white"><i class="fab fa-twitter"></i> Follow</a>
                    <a href="#" class="text-white"><i class="fab fa-instagram"></i> Follow</a>
                    <a href="#" class="text-white"><i class="fab fa-youtube"></i> Follow</a>
                    <a href="#" class="text-white"><i class="fab fa-tiktok"></i> Follow</a>
                    <a href="#" class="text-white"><i class="fas fa-envelope"></i> Mail us</a>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
