<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profil User - SATRIA</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
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
            <h1 class="text-3xl font-bold text-center">Edit Profil User</h1>
        </header>
        <main>
            <form action="{{ route('user.update', $user->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT') <!-- Specify PUT method for updating -->
                
                <!-- 1. Username -->
                <div>
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $user->username) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('username')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 2. Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('email')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 3. Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password </label>
                    <input type="password" id="password" name="password" placeholder="Masukkan Password Baru" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('password')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>
            
                <!-- 4. Jenis -->
                <div>
                    <label for="jenis" class="block text-sm font-medium text-gray-700">Jenis</label>
                    <select name="jenis" id="jenis" required class="mt-1 block w-full px-3 py-2 border border-gray-300 bg-white rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option value="individu" {{ old('jenis', $user->jenis) == 'individu' ? 'selected' : '' }}>Individu</option>
                        <option value="organisasi" {{ old('jenis', $user->jenis) == 'organisasi' ? 'selected' : '' }}>Organisasi</option>
                        <option value="admin" {{ old('jenis', $user->jenis) == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                    @error('jenis')
                        <div class="text-red-500 text-sm mt-1">{{ $message }}</div>
                    @enderror
                </div>

            
                <!-- Submit Button -->
                <div>
                    <button type="submit" class="w-full bg-indigo-600 text-white py-2 px-4 rounded-md shadow-sm hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Update Profile
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
