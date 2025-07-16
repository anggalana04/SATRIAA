<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kegiatan</title>
    <!-- Add Tailwind CSS CDN for styling -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Optionally, you can add custom styling -->
    <style>
        .custom-card {
            border-radius: 15px;
        }
    </style>
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <h1 class="text-4xl text-center text-indigo-600 font-bold mb-6">{{ $kegiatan->nama }}</h1>

        <!-- Card to show event details -->
        <div class="bg-white shadow-lg rounded-lg custom-card mb-6">
            <div class="bg-indigo-600 text-white p-4 rounded-t-lg">
                <h2 class="text-2xl font-semibold">Detail Kegiatan</h2>
            </div>
            <div class="p-6">
                <h3 class="text-xl font-semibold text-gray-800">{{ $kegiatan->nama }}</h3>
                <p class="text-gray-700 my-2">{{ $kegiatan->deskripsi }}</p>
                <p class="text-gray-600"><strong>Tanggal:</strong> {{ $kegiatan->tanggal_mulai }} - {{ $kegiatan->tanggal_selesai }}</p>
                <p class="text-gray-600"><strong>Lokasi:</strong> {{ $kegiatan->lokasi }}</p>
            </div>
        </div>

        <!-- Pendaftaran Form -->
        <form action="{{ route('kegiatan.store_pendaftaran', $kegiatan->id) }}" method="POST" class="space-y-4 bg-white shadow-lg p-6 rounded-lg">
            @csrf
            <div>
                <label for="alasan" class="block text-sm font-medium text-gray-700">Alasan Mengikuti Kegiatan</label>
                <textarea name="alasan" id="alasan" class="mt-2 p-3 border border-gray-300 rounded-lg w-full @error('alasan') border-red-500 @enderror" rows="4" required>{{ old('alasan') }}</textarea>
                @error('alasan')
                    <div class="text-sm text-red-500 mt-1">
                        <strong>{{ $message }}</strong>
                    </div>
                @enderror
            </div>

            <button type="submit" class="w-full bg-indigo-600 text-white py-3 rounded-lg hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
                Daftar Kegiatan
            </button>
        </form>
    </div>
</body>
</html>
