<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $kegiatan->nama }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet"/>
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
        
    </header>
    <main class="container mx-auto p-4 mt-16"> <!-- Add margin to the top -->
        <h1 class="text-3xl font-bold mb-2 ">{{ $kegiatan->nama }}</h1>
        <p class="text-gray-600 mb-4"><i class="fas fa-map-marker-alt"></i> {{ $kegiatan->lokasi }}</p>
        <div class="flex flex-col lg:flex-row gap-4">
            <!-- Adjust the left card width to be smaller -->
            <div class="bg-white p-4 rounded-lg shadow-md w-full lg:w-1/3"> <!-- Adjust the width here -->
                <img src="{{ asset($kegiatan->foto) }}" alt="Kegiatan Image" class="w-full rounded-lg mb-4">
                @if ($kegiatan->status === 'pending')
                <h3 class="text-red-500 font-bold">Kegiatan Belum Tersedia</h3>
                @else
                <a href="{{ route('kegiatan.daftar', $kegiatan->id) }}" class="w-full bg-red-500 text-white py-2 rounded-lg mb-4 flex items-center justify-center">
                    <i class="fas fa-user-plus mr-2"></i> DAFTAR
                </a>
                @endif
                <p class="text-gray-600 mb-4">{{ $kegiatan->jumlah_relawan_dibutuhkan }} relawan di butuhkan</p>
                <div class="text-gray-600">
                    <p class="mb-2"><strong>CATEGORY</strong></p>
                    <p class="mb-4">{{ $kegiatan->kategori }}</p>
                    <p class="mb-2"><strong>SUB-CATEGORY</strong></p>
                    <p class="mb-4">Other</p>
                    <p class="mb-2"><strong>Duration</strong></p>
                    <p>4-8 hours</p>
                </div>
            </div>
            
            <div class="flex-1">
                <div class="bg-white p-4 rounded-lg shadow-md mb-4">
                    <h2 class="text-xl font-bold mb-2">Apa yang bisa anda bantu?</h2>
                    <p class="text-gray-600 mb-4">Bantu {{ $kegiatan->deskripsi }} dengan {{ $kegiatan->jumlah_relawan_dibutuhkan }} relawan.</p>
                    <h2 class="text-xl font-bold mb-2">Berikut sedikit informasi lebih lanjut tentang peluang ini...</h2>
                    <p class="text-gray-600 mb-4">{{ $kegiatan->deskripsi }}</p>
                </div>
                <div class="bg-white p-4 rounded-lg shadow-md">
                    <h2 class="text-xl font-bold mb-2">Tentang Organisasi</h2>
                    <div class="flex items-center mb-4">
                        <img src="{{ asset('storage/'.$organisasi->foto) }}" alt="Organization Logo" class="h-12 mr-4">
                        <div>
                            <p class="font-bold">{{ $organisasi->nama }}</p>
                            <p class="text-gray-600">Schools</p>
                            <p class="text-gray-600">
                                <i class="fas fa-star text-red-500"></i>
                                5 from 1 activities
                            </p>
                        </div>
                    </div>
                    <p class="text-gray-600 mb-4">{{ $organisasi->visi }}</p>
                    <a href="{{ route('organisasi.show', $organisasi->id) }}">
                        <button class="bg-red-500 text-white py-2 px-4 rounded-lg">Profil Organisasi</button>
                    </a>
                    
                </div>
            </div>
        </div>
    </main>
    <section class="bg-red-500 text-white p-8 mt-8">
        <div class="container mx-auto text-center">
            <h2 class="text-2xl font-bold mb-4">Jadilah Inspirasi!</h2>
            <p class="mb-4">Kami akan mengirimi Anda berita, kampanye nasional dan internasional, serta cara-cara menarik untuk berkontribusi.</p>
            <div class="flex flex-col md:flex-row justify-center items-center gap-4">
                <input type="text" placeholder="Nama" class="p-2 rounded-md text-gray-800">
                <input type="text" placeholder="Nama belakang" class="p-2 rounded-md text-gray-800">
                <input type="email" placeholder="Email" class="p-2 rounded-md text-gray-800">
                <select class="p-2 rounded-md text-gray-800">
                    <option>Langganan</option>
                </select>
                <button class="bg-gray-800 text-white py-2 px-4 rounded-md">Langganan</button>
            </div>
        </div>
    </section>
    <footer class="bg-gray-800 text-white p-8">
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
            <div class="flex flex-col md:flex-row items-center gap-4 mt-4 md:mt-0">
                <div class="text-center md:text-left">
                    <p class="font-bold">Volunteer</p>
                    <p>Donate</p>
                    <p>Find Causes</p>
                </div>
                <div class="text-center md:text-left">
                    <p class="font-bold">Campaigns</p>
                    <p>Offers</p>
                    <p>Create an Offer</p>
                    <p>For Causes</p>
                </div>
                <div class="text-center md:text-left">
                    <p class="font-bold">For Businesses</p>
                    <p>Employee Volunteering</p>
                    <p>Events, Activation & Research</p>
                </div>
                <div class="text-center md:text-left">
                    <p class="font-bold">Resources</p>
                    <p>Information Center</p>
                    <p>FAQ</p>
                    <p>Contact us</p>
                    <p>Sign in</p>
                </div>
            </div>
        </div>
    </footer>
</body>
</html>
