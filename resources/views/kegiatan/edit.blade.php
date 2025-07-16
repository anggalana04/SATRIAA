<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Kegiatan! - SATRIA</title>
    <link rel="stylesheet" href="{{asset('styless/kegiatan.css')}}">
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
        <h1>EDIT KEGIATAN</h1>
    </header>
    <main>
        <form action="{{ route('kegiatan.update', $kegiatan->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            
            <!-- 1. Nama Kegiatan -->
            <div class="form-input-container" style="margin-top: 3rem;">
                <label for="nama">1. Nama Kegiatan</label><br>
                <input type="text" class="form-input" id="nama" name="nama" placeholder="Masukan Judul Kegiatan" value="{{ old('nama', $kegiatan->nama) }}" required><br>
            </div>
        
            <!-- 2. Tanggal Mulai -->
            <div class="form-input-container">
                <label for="tanggal_mulai">2. Tanggal Mulai</label><br>
                <input type="date" class="form-input" id="tanggal_mulai" name="tanggal_mulai" value="{{ old('tanggal_mulai', $kegiatan->tanggal_mulai) }}" required><br>
            </div>
        
            <!-- 3. Tanggal Selesai -->
            <div class="form-input-container">
                <label for="tanggal_selesai">3. Tanggal Selesai</label><br>
                <input type="date" class="form-input" id="tanggal_selesai" name="tanggal_selesai" value="{{ old('tanggal_selesai', $kegiatan->tanggal_selesai) }}" required><br>
            </div>
        
            <!-- 4. Deskripsi Kegiatan -->
            <div class="form-input-container">
                <label for="deskripsi">4. Deskripsi Kegiatan</label><br>
                <textarea name="deskripsi" id="deskripsi" class="form-input" placeholder="Masukan Deskripsi Kegiatan" rows="4" required>{{ old('deskripsi', $kegiatan->deskripsi) }}</textarea>
            </div>
        
            <!-- 5. Kategori -->
            <div class="form-input-container">
                <label for="kategori">5. Kategori</label><br>
                <select name="kategori" id="kategori" required>
                    <option value="Kesehatan" {{ old('kategori', $kegiatan->kategori) == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                    <option value="Bencana" {{ old('kategori', $kegiatan->kategori) == 'Bencana' ? 'selected' : '' }}>Bencana</option>
                    <option value="Pendidikan" {{ old('kategori', $kegiatan->kategori) == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                    <option value="Sosial dan Kesejahteraan" {{ old('kategori', $kegiatan->kategori) == 'Sosial dan Kesejahteraan' ? 'selected' : '' }}>Sosial dan Kesejahteraan</option>
                    <option value="Pemberdayaan Masyrakat" {{ old('kategori', $kegiatan->kategori) == 'Pemberdayaan Masyarakat' ? 'selected' : '' }}>Pemberdayaan Masyarakat</option>
                    <option value="Keagamaan" {{ old('kategori', $kegiatan->kategori) == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                    <option value="Lainnya" {{ old('kategori', $kegiatan->kategori) == 'Lainnya' ? 'selected' : '' }}>Lainnya</option>
                </select>
            </div>
        
            <!-- 6. Lokasi -->
            <div class="form-input-container">
                <label for="lokasi">6. Lokasi</label><br>
                <input type="text" name="lokasi" id="lokasi" class="form-input" placeholder="Masukan Lokasi Kegiatan" value="{{ old('lokasi', $kegiatan->lokasi) }}" required>
            </div>
        
            <!-- 7. Kontak -->
            <div class="form-input-container">
                <label for="kontak">7. Kontak</label><br>
                <input type="text" name="kontak" id="kontak" class="form-input" placeholder="Masukkan Kontak" value="{{ old('kontak', $kegiatan->kontak) }}" required>
            </div>
        
            <!-- 8. Status -->
            <div class="form-input-container">
                <label for="status">8. Status</label><br>
                <select name="status" id="status" required>
                    <option value="pending" {{ old('status', $kegiatan->status) == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="aktif" {{ old('status', $kegiatan->status) == 'aktif' ? 'selected' : '' }}>Aktif</option>
                    <option value="selesai" {{ old('status', $kegiatan->status) == 'selesai' ? 'selected' : '' }}>Selesai</option>
                </select>
            </div>
        
            <!-- 9. Upload Foto -->
            <div class="form-input-container">
                <label for="foto">9. Upload Foto</label><br>
                <input type="file" name="foto" id="foto" accept="image/*" onchange="previewImage(event)">
                @if($kegiatan->foto)
                    <img src="{{ asset('images/' . $kegiatan->foto) }}" alt="Current Foto" class="current-foto">
                @endif
                <img id="image-preview" class="image-preview" src="#" alt="Image Preview">
            </div>
        
            <!-- Buttons -->
            <button type="submit" class="confirm">UPDATE</button>
            <button type="button" class="reset">
                <a href="{{ route('kegiatan.index') }}" style="text-decoration: none; color: inherit;">KEMBALI</a>
            </button>
        </form>
    </main>
</body>
</html>
