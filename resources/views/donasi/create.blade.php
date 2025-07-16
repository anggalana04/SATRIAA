<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Buat Donasi Baru - SATRIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
        }
        .image-preview {
            display: none;
            margin-top: 10px;
            max-width: 200px;
        }
    </style>
    <script>
        function previewImage(event) {
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function (e) {
                const preview = document.getElementById('image-preview');
                preview.src = e.target.result;
                preview.style.display = 'block';
            };

            reader.readAsDataURL(file);
        }
    </script>
</head>
<body class="bg-yellow-100 min-h-screen flex flex-col items-center">
    <header class="w-full bg-yellow-500 py-4 shadow-md">
        <h1 class="text-3xl font-bold text-center text-white">BUAT KEGIATAN DONASI</h1>
    </header>
    <main class="w-full max-w-2xl bg-white p-8 mt-8 rounded-lg shadow-lg">
        <form action="{{ route('donasi.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- 1. Nama Donasi -->
            <div class="mb-6">
                <label for="nama" class="block text-lg font-semibold mb-2">1. Nama Donasi</label>
                <input type="text" class="w-full p-3 border border-gray-300 rounded-lg" id="nama" name="nama" placeholder="Masukkan Nama Donasi" required>
            </div>

            <!-- 2. Tanggal Mulai -->
            <div class="mb-6">
                <label for="tanggal_mulai" class="block text-lg font-semibold mb-2">2. Tanggal Mulai</label>
                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>

            <!-- 3. Tanggal Selesai -->
            <div class="mb-6">
                <label for="tanggal_selesai" class="block text-lg font-semibold mb-2">3. Tanggal Selesai</label>
                <input type="date" class="w-full p-3 border border-gray-300 rounded-lg" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>

            <!-- 4. Deskripsi -->
            <div class="mb-6">
                <label for="deskripsi" class="block text-lg font-semibold mb-2">4. Deskripsi</label>
                <textarea name="deskripsi" id="deskripsi" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Deskripsi Donasi" rows="4" required></textarea>
            </div>

            <!-- 5. Target Donasi -->
            <div class="mb-6">
                <label for="target_donasi" class="block text-lg font-semibold mb-2">5. Target Donasi (Rp)</label>
                <input type="number" step="0.01" name="target_donasi" id="target_donasi" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Target Donasi (Opsional)">
            </div>

            <!-- 6. Lokasi -->
            <div class="mb-6">
                <label for="lokasi" class="block text-lg font-semibold mb-2">6. Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="w-full p-3 border border-gray-300 rounded-lg" placeholder="Masukkan Lokasi Donasi" required>
            </div>

            <!-- 7. Status -->
            <div class="mb-6">
                <label for="status" class="block text-lg font-semibold mb-2">7. Status</label>
                <select name="status" id="status" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    <option value="pending">Pending</option>
                    <option value="aktif">Aktif</option>
                    <option value="selesai">Selesai</option>
                </select>
            </div>

            <!-- 8. Kategori -->
            <div class="mb-6">
                <label for="kategori" class="block text-lg font-semibold mb-2">8. Kategori</label>
                <select name="kategori" id="kategori" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Bencana">Bencana</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Sosial dan Kesejahteraan">Sosial dan Kesejahteraan</option>
                    <option value="Pemberdayaan Masyarakat">Pemberdayaan Masyarakat</option>
                    <option value="Keagamaan">Keagamaan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>

            <!-- 9. Tipe Donasi -->
            <div class="mb-6">
                <label for="tipe" class="block text-lg font-semibold mb-2">9. Tipe Donasi</label>
                <select name="tipe" id="tipe" class="w-full p-3 border border-gray-300 rounded-lg" required>
                    <option value="uang">Uang</option>
                    <option value="barang">Barang</option>
                </select>
            </div>

            <!-- 10. Upload Foto -->
            <div class="mb-6">
                <label for="foto" class="block text-lg font-semibold mb-2">10. Upload Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*" class="w-full p-3 border border-gray-300 rounded-lg" onchange="previewImage(event)">
                <img id="image-preview" class="image-preview mt-4" src="#" alt="Image Preview">
            </div>

            <!-- 11. Nomor Rekening Tujuan -->
            <div class="mb-6">
                <label for="rekening/VA" class="block text-lg font-semibold mb-2">11. Nomor Rekening Tujuan</label>
                <input type="text" name="rekening/VA" id="rekening/VA" class="w-full p-3 border border-gray-300 rounded-lg">
            </div>

            <!-- Buttons -->
            <div class="flex justify-between">
                <button type="submit" class="bg-yellow-500 text-white font-bold py-2 px-4 rounded-lg shadow-md hover:bg-yellow-600 transition duration-300">KIRIM</button>
                <button type="button" class="bg-gray-300 text-gray-700 font-bold py-2 px-4 rounded-lg shadow-md hover:bg-gray-400 transition duration-300">
                    <a href="{{ route('donasi.index') }}" style="text-decoration: none; color: inherit;">ULANGI</a>
                </button>
            </div>
        </form>
    </main>
</body>
</html>