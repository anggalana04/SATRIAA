<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajukan Kegiatan! - SATRIA</title>
    <link rel="stylesheet" href="{{asset('styless/kegiatan.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <style>
        body {
            font-family: 'Montserrat', sans-serif;
            background-color: #fec0c0;
        }
        .image-preview {
            display: none;
            margin-top: 10px;
            max-width: 200px;
        }
        .form-input-container {
            margin-bottom: 1rem;
        }
        label {
            font-size: 1.1rem;
            font-weight: 600;
        }
        input, textarea, select {
            width: 100%;
            padding: 0.8rem;
            border: 1px solid #ccc;
            border-radius: 0.5rem;
            font-size: 1rem;
            margin-top: 0.5rem;
        }
        .form-input:focus, select:focus {
            border-color: #fdbd3e;
            outline: none;
        }
        .btn {
            background-color: #fdbd3e;
            color: white;
            padding: 0.8rem 1.6rem;
            border-radius: 0.5rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s;
        }
        .btn:hover {
            background-color: #f39c12;
        }
        .reset-btn {
            background-color: #e2e2e2;
            color: #333;
            font-weight: 600;
            padding: 0.8rem 1.6rem;
            border-radius: 0.5rem;
            text-decoration: none;
            display: inline-block;
            margin-left: 1rem;
        }
        .reset-btn:hover {
            background-color: #bbb;
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
    <header style="background-color: #FD4755; padding: 2rem 0;">
        <h1 style="text-align: center; font-size: 2rem; color: white;">PENGAJUAN KEGIATAN</h1>
    </header>
    <main class="container" style="max-width: 900px; margin: 0 auto; padding: 2rem; background-color: white; border-radius: 1rem; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);">
        <form action="{{ route('kegiatan.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <!-- 1. Nama Kegiatan -->
            <div class="form-input-container">
                <label for="nama">1. Nama Kegiatan</label>
                <input type="text" class="form-input" id="nama" name="nama" placeholder="Masukan Judul Kegiatan" required>
            </div>
        
            <!-- 2. Tanggal Mulai -->
            <div class="form-input-container">
                <label for="tanggal_mulai">2. Tanggal Mulai</label>
                <input type="date" class="form-input" id="tanggal_mulai" name="tanggal_mulai" required>
            </div>
        
            <!-- 3. Tanggal Selesai -->
            <div class="form-input-container">
                <label for="tanggal_selesai">3. Tanggal Selesai</label>
                <input type="date" class="form-input" id="tanggal_selesai" name="tanggal_selesai" required>
            </div>
        
            <!-- 4. Deskripsi Kegiatan -->
            <div class="form-input-container">
                <label for="deskripsi">4. Deskripsi Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" class="form-input" placeholder="Masukan Deskripsi Kegiatan" rows="4" required></textarea>
            </div>
        
            <!-- 5. Jumlah Relawan Dibutuhkan -->
            <div class="form-input-container">
                <label for="jumlah_relawan_dibutuhkan">5. Jumlah Relawan Dibutuhkan</label>
                <input type="number" name="jumlah_relawan_dibutuhkan" id="jumlah_relawan_dibutuhkan" class="form-input" placeholder="Masukkan Jumlah Relawan Dibutuhkan" required>
            </div>
        
            <!-- 7. Lokasi -->
            <div class="form-input-container">
                <label for="lokasi">7. Lokasi</label>
                <input type="text" name="lokasi" id="lokasi" class="form-input" placeholder="Masukan Lokasi Kegiatan" required>
            </div>
        
            <!-- 8. Kontak -->
            <div class="form-input-container">
                <label for="kontak">8. Kontak</label>
                <input type="text" name="kontak" id="kontak" class="form-input" placeholder="Masukkan Kontak" required>
            </div>
        
            <!-- 10. Kategori -->
            <div class="form-input-container">
                <label for="kategori">9. Kategori</label>
                <select name="kategori" id="kategori" required>
                    <option value="Kesehatan">Kesehatan</option>
                    <option value="Bencana">Bencana</option>
                    <option value="Pendidikan">Pendidikan</option>
                    <option value="Sosial dan Kesejahteraan">Sosial dan Kesejahteraan</option>
                    <option value="Pemberdayaan Masyrakat">Pemberdayaan Masyarakat</option>
                    <option value="Keagamaan">Keagamaan</option>
                    <option value="Lainnya">Lainnya</option>
                </select>
            </div>
        
            <!-- 11. Upload Foto -->
            <div class="form-input-container">
                <label for="foto">10. Upload Foto</label>
                <input type="file" name="foto" id="foto" accept="image/*" required onchange="previewImage(event)">
                <img id="image-preview" class="image-preview" src="#" alt="Image Preview">
            </div>
        
            <!-- Buttons -->
            <div style="display: flex; justify-content: space-between; margin-top: 2rem;">
                <button type="submit" class="btn">KIRIM</button>
                <button type="button" class="reset-btn">
                    <a href="{{ route('kegiatan.index') }}" style="text-decoration: none; color: inherit;">ULANGI</a>
                </button>
            </div>
        </form>
    </main>
</body>
</html>
