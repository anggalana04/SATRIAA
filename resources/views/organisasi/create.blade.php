<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ajukan Organisasi! - SATRIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"></link>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-2xl overflow-y-auto max-h-screen">
        <header class="mb-6">
            <h1 class="text-3xl font-bold text-center">Lengkapi Identitas Organisasimu</h1>
        </header>
        <main>
            <form action="{{ route('organisasi.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                
                <!-- 1. Nama Organisasi -->
                <div>
                    <label for="nama" class="block text-sm font-medium text-gray-700">1. Nama Organisasi</label>
                    <input type="text" id="nama" name="nama" placeholder="Masukkan Nama Organisasi" value="{{ old('nama') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('nama')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 2. Alamat -->
                <div>
                    <label for="alamat" class="block text-sm font-medium text-gray-700">2. Alamat</label>
                    <input type="text" id="alamat" name="alamat" placeholder="Masukkan Alamat" value="{{ old('alamat') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('alamat')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 3. Ketua -->
                <div>
                    <label for="ketua" class="block text-sm font-medium text-gray-700">3. Ketua</label>
                    <input type="text" id="ketua" name="ketua" placeholder="Masukkan Ketua" value="{{ old('ketua') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('ketua')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 4. Kategori -->
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">4. Kategori</label>
                    <select name="kategori" id="kategori" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="Kesehatan" {{ old('kategori') == 'Kesehatan' ? 'selected' : '' }}>Kesehatan</option>
                        <option value="Pendidikan" {{ old('kategori') == 'Pendidikan' ? 'selected' : '' }}>Pendidikan</option>
                        <option value="Lingkungan Hidup" {{ old('kategori') == 'Lingkungan Hidup' ? 'selected' : '' }}>Lingkungan Hidup</option>
                        <option value="HAM" {{ old('kategori') == 'HAM' ? 'selected' : '' }}>HAM</option>
                        <option value="Keagamaan" {{ old('kategori') == 'Keagamaan' ? 'selected' : '' }}>Keagamaan</option>
                        <option value="Olahraga dan Kesenian" {{ old('kategori') == 'Olahraga dan Kesenian' ? 'selected' : '' }}>Olahraga dan Kesenian</option>
                    </select>
                    @error('kategori')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 5. Visi -->
                <div>
                    <label for="visi" class="block text-sm font-medium text-gray-700">5. Visi</label>
                    <input type="text" id="visi" name="visi" placeholder="Masukkan Visi Organisasi" value="{{ old('visi') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('visi')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 6. Misi -->
                <div>
                    <label for="misi" class="block text-sm font-medium text-gray-700">6. Misi</label>
                    <input type="text" id="misi" name="misi" placeholder="Masukkan Misi Organisasi" value="{{ old('misi') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('misi')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 7. Sertifikasi -->
                <div>
                    <label for="id_sertifikasi" class="block text-sm font-medium text-gray-700">7. Sertifikasi</label>
                    <input type="text" id="id_sertifikasi" name="id_sertifikasi" placeholder="Masukkan ID Sertifikasi" value="{{ old('id_sertifikasi') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('id_sertifikasi')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 8. Foto -->
                <div>
                    <label for="foto" class="block text-sm font-medium text-gray-700">8. Foto</label>
                    <input type="file" id="foto" name="foto" accept="image/jpeg,image/png,image/jpg,image/gif" value="{{ old('foto') }}" class="mt-1 block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
                    <img id="image-preview" class="image-preview" src="" alt="Image Preview">
                    @error('foto')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 9. Rating -->
                <div>
                    <label for="rating" class="block text-sm font-medium text-gray-700">9. Rating</label>
                    <input type="text" id="rating" name="rating" placeholder="Masukkan Rating" value="{{ old('rating') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('rating')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 10. Tiktok -->
                <div>
                    <label for="tiktok" class="block text-sm font-medium text-gray-700">10. Tiktok</label>
                    <input type="text" id="tiktok" name="tiktok" placeholder="Masukkan Tiktok" value="{{ old('tiktok') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('tiktok')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 11. Instagram -->
                <div>
                    <label for="instagram" class="block text-sm font-medium text-gray-700">11. Instagram</label>
                    <input type="text" id="instagram" name="instagram" placeholder="Masukkan Instagram" value="{{ old('instagram') }}" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('instagram')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 12. Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">12. Email</label>
                    <input type="email" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 13. WA -->
                <div>
                    <label for="wa" class="block text-sm font-medium text-gray-700">13. WA</label>
                    <input type="text" id="wa" name="wa" placeholder="Masukkan WA" value="{{ old('wa') }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('wa')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Submit
                    </button>
                </div>
            </form>
        </main>
    </div>

    <script>
        document.getElementById('foto').addEventListener('change', function(event) {
            var reader = new FileReader();
            reader.onload = function(e) {
                var preview = document.getElementById('image-preview');
                preview.style.display = 'block';
                preview.src = e.target.result;
            }
            reader.readAsDataURL(event.target.files[0]);
        });
    </script>
</body>
</html>