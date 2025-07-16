<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Donasi untuk {{ $donasi->nama }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }
        .container {
            margin: 20px auto;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        input[type="text"], input[type="number"], textarea, select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            font-size: 14px;
        }
        textarea {
            resize: none;
            height: 100px;
        }
        button {
            background-color: #28a745;
            color: white;
            border: none;
            padding: 10px;
            font-size: 16px;
            border-radius: 5px;
            cursor: pointer;
        }
        button:hover {
            background-color: #218838;
        }
        .program-info {
            text-align: center;
            margin-bottom: 20px;
        }
        .program-info p {
            margin: 5px 0;
            color: #777;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Donasi untuk {{ $donasi->nama }}</h1>
        <div class="program-info">
            <p><strong>Target Donasi:</strong> Rp{{ number_format($donasi->target_donasi, 0, ',', '.') }}</p>
            <p><strong>Dana Terkumpul:</strong> Rp{{ number_format($donasi->jumlah_donasi, 0, ',', '.') }}</p>
        </div>
        <form action="{{ route('transaksi_donasi.store') }}" method="POST">
            @csrf
            <input type="hidden" name="donasi_id" value="{{ $donasi->id }}">
            
            <label for="nama">Nama Donatur</label>
            <input type="text" id="nama" name="nama" placeholder="Masukkan nama Anda" required>
            
            <label for="jumlah_donasi">Jumlah Donasi (Rp)</label>
            <input type="number" id="jumlah_donasi" name="jumlah_donasi" placeholder="Masukkan jumlah donasi" required>
            
            <label for="pesan">Pesan (Opsional)</label>
            <textarea id="pesan" name="pesan" placeholder="Tulis pesan untuk donasi Anda"></textarea>
            
           
            
            <button type="submit">Donasi Sekarang</button>
        </form>
    </div>
</body>
</html>
