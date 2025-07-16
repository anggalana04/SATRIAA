<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Donasi - SATRIA</title>
    <link rel="stylesheet" href="{{ asset('styless/donasi.css') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
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
<body>
    <header>
        <h1>EDIT KEGIATAN DONASI</h1>
    </header>
    <main>
        <form action="{{ route('donasi.update', $donasi->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- 1. Nama Donasi -->
            <div class="form-input-container" style="margin-top: 3rem;">
                <label for="nama">1. Nama Donasi</label><br>
                <input type="text" class="form-input" id="nama" name="nama" value="{{ old('nama', $donasi->nama) }}" required>
            </div>

            <!-- 2. Tanggal Mulai -->
            <div class="form-input-container">
                <label for="tanggal_mulai">2. Tanggal Mulai</label><br>
                <input type="date" class="form-input" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $donasi->tanggal_mulai) }}" required>
            </div>

            <!-- 3. Tanggal Selesai -->
            <div class="form-input-container">
                <label for="tanggal_selesai">3. Tanggal Selesai</label><br>
                <input type="date" class="form-input" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $donasi->tanggal_selesai) }}" required>
            </div>

            <!-- 4. Deskripsi -->
            <div class="form-input-container">
                <label for="deskripsi">4. Deskripsi</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-input" placeholder="Masukkan Deskripsi Donasi" rows="4" required>{{ old('deskripsi', $donasi->deskripsi) }}</textarea>
            </div>

            <!-- 5. Target Donasi -->
            <div class="form-input-container">
                <label for="target_donasi">5. Target Donasi (Rp)</label><br>
                <input type="number" step="0.01" name="target_donasi" id="target_donasi" class="form-input" placeholder="Masukkan Target Donasi (Opsional)" value="{{ old('target_donasi', $donasi->target_donasi) }}">
            </div>

            <!-- 6. Lokasi -->
            <div class="form-input-container">
                <label for="lokasi">6. Lokasi</label><br>
                <input type="text" name="lokasi" id="lokasi" class="form-input" placeholder="Masukkan Lokasi Donasi" value="{{ old('lokasi', $donasi->lokasi) }}" required>
            </div>

            <!-- 7. Status -->
            <div class="form-input-container">
                <label for="status">7. Status</label><br>
                <select name="status" id="status" required>
                    <option value="pending" {{ $donasi->status == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="aktif" {{ $donasi->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ $donasi->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>

            <!-- 8. Kategori -->
            <div class="form-input-container">
                <label for="kategori">8. Kategori</label><br>
                <select name="kategori" id="kategori" required>
                    <option value="Kesehatan" {{ $donasi->kategori == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Bencana" {{ $donasi->kategori == 'Bencana' ? 'selected' : '' }}>Bencana</option>
                    <option value="Pendidikan" {{ $donasi->kategori == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Sosial dan Kesejahteraan" {{ $donasi->kategori == 'Sosial dan Kesejahteraan' ? 'selected' : '' }}>Sosial dan Kesejahteraan</option>
                    <option value="Pemberdayaan Masyarakat" {{ $donasi->kategori == 'Pemberdayaan Masyarakat' ? 'selected' : '' }}>Pemberdayaan Masyarakat</option>
                    <option value="Keagamaan" {{ $donasi->kategori == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                    <option value="Lainnya" {{ $donasi->kategori == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>

            <!-- 9. Tipe Donasi -->
            <div class="form-input-container">
                <label for="tipe">9. Tipe Donasi</label><br>
                <select name="tipe" id="tipe" required>
                    <option value="uang" {{ $donasi->tipe == 'uang' ? 'selected' : '' }}>Uang</option>
                    <option value="barang" {{ $donasi->tipe == 'barang' ? 'selected' : '' }}>Barang</option>
                </select>
            </div>

            <!-- 10. Upload Foto -->
            <div class="form-input-container">
                <label for="foto">10. Upload Foto</label><br>
                <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)">
                <img id="image-preview" class="image-preview" src="{{ $donasi->foto ? Storage::url($donasi->foto) : '#' }}" alt="Image Preview">
            </div>

            <!-- Buttons -->
            <button type="submit" class="confirm">UPDATE</button>
            <button type="button" class="reset">
                <a href="{{ route('donasi.index') }}" style="text-decoration: none; color: inherit;">BATAL</a>
            </button>
        </form>
    </main>
</body>
</html>
