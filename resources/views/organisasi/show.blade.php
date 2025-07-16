<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $organization->nama }} - Organization Page</title>
    <link rel="stylesheet" href="{{ asset('styless/organisasi2.css') }}">
</head>
<body>
    <!-- Header -->
    <header class="header">
        <div class="logo">Logo</div>
        <div class="search-bar">
            <input type="text" placeholder="Search">
            <button>🔍</button>
        </div>
        <nav>
            <a href="#">Relawan</a>
            <a href="#">Donasi</a>
            <a href="#">Organisasi</a>
        </nav>
        <div class="profile-icon">👤</div>
    </header>

    <!-- Organization Details -->
    <section class="organization-details">
        <h1>{{ $organization->nama }}</h1>
        <p><strong>Location:</strong> {{ $organization->alamat }}</p>
        <div class="details">
            <img src="{{ asset('storage/' . $organization->foto) }}" alt="Organization Image">
            <div>
                <button class="support-btn">Dukung</button>
                <p><strong>Kategori:</strong> {{ $organization->kategori }}</p>
            </div>
        </div>

        <!-- Activities Section -->
        <div class="activities">
            <h2>Kegiatan</h2>

            @foreach ($activities as $activity)
                <div class="activity">
                    <h3>{{ $activity->nama }}</h3>
                    <p><strong>Location:</strong> {{ $activity->lokasi }}</p>
                    <p>{{ $activity->deskripsi }}</p>
                    <button class="register">Daftar</button>
                </div>
            @endforeach
        </div>
    </section>

    <!-- Footer -->
    <footer>
        Jadilah Inspirasi!
    </footer>
</body>
</html>
