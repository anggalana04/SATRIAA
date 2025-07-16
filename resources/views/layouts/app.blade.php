<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Dashboard SATRIA</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100..900&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet">
    <style>
        * {
            font-family: 'Montserrat', sans-serif;
        }
    </style>
</head>
<body>
    <div class="flex h-screen">
        <!-- Sidebar -->
        <div class="w-64 bg-gray-200 h-full p-4">
            <div class="flex items-center mb-8">
                <img src="{{ asset('image/logo-satria.png') }}" alt="Logo" class="w-10 h-10 mr-2">
                <span class="text-xl font-bold">SATRIA</span>
            </div>
            <nav>
                @if (Auth::user()->jenis === 'admin') 
                    <a href="{{ route('dashboardAdmin') }}" 
                    class="flex items-center p-2 rounded-lg hover:bg-gray-300 transition-colors {{ request()->routeIs('dashboardAdmin') ? 'bg-gray-300' : '' }}">
                     <i class="fas fa-calendar-alt mr-2"></i>
                     <span>Data Master</span>
                 </a>
                
                @elseif ((Auth::user()->jenis === 'organisasi'))
                <div class="space-y-2">
                    <!-- Dashboard Kegiatan -->
                    <a href="{{ route('dashboardOrganisasiKegiatan') }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-300 transition-colors {{ request()->routeIs('dashboardOrganisasiKegiatan') ? 'bg-gray-300' : '' }}">
                        <i class="fas fa-calendar-alt mr-2"></i>
                        <span>Dashboard Kegiatan</span>
                    </a>

                    <!-- Dashboard Pendaftar -->
                    <a href="{{ route('dashboardOrganisasiPendaftar') }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-300 transition-colors {{ request()->routeIs('dashboardOrganisasiPendaftar') ? 'bg-gray-300' : '' }}">
                        <i class="fas fa-users mr-2"></i>
                        <span>Dashboard Pendaftar</span>
                    </a>

                    <!-- Dashboard Donasi -->
                    <a href="{{ route('dashboardOrganisasiDonasi') }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-300 transition-colors {{ request()->routeIs('dashboardOrganisasiDonasi') ? 'bg-gray-300' : '' }}">
                        <i class="fas fa-donate mr-2"></i>
                        <span>Dashboard Donasi</span>
                    </a>

                    <a href="{{ route('transaksi_donasi.riwayat') }}" 
                       class="flex items-center p-2 rounded-lg hover:bg-gray-300 transition-colors {{ request()->routeIs('transaksi_donasi.riwayat') ? 'bg-gray-300' : '' }}">
                        <i class="fas fa-donate mr-2"></i>
                        <span>Riwayat Donasi</span>
                    </a>

                    
                </div>
            </nav>
                @endif
                

            <div class="absolute bottom-4 left-4 flex items-center">
                
                @if (Auth::user()->jenis === 'admin')
    <!-- Hanya menampilkan username jika user adalah admin -->
    <div>
        <div class="font-bold">{{ Auth::user()->username }}</div>
    </div>    
@else
    <!-- Menampilkan foto dan informasi organisasi jika user bukan admin -->
    <div class="flex items-center">
        <img src="{{ asset('storage/' . $organisasi->foto) }}" alt="Organization Logo" class="w-10 h-10 mr-2 rounded-md">
        <div>
            <div class="font-bold">{{ $organisasi->nama }}</div>
            <div class="text-sm">{{ $organisasi->kategori }}</div>
        </div>
    </div>
@endif

                
                <!-- Logout Button -->
                <form action="{{ route('logout') }}" method="POST" class="ml-4">    
                    @csrf
                    <button type="submit" class="text-red-500 hover:text-red-700">
                        <i class="fas fa-sign-out-alt ml-12"></i>
                    </button>
                </form>
            </div>
            
        </div>

        <!-- Main Content -->
        <div class="flex-1 bg-gray-100 p-6 overflow-y-auto">
            @yield('content')
        </div>
    </div>
</body>
</html>