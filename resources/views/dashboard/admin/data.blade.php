@extends('layouts.app')

@section('content')
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Data Master</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 font-sans">
    <div class="p-6">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <div class="flex justify-between items-center mb-6">
                <h1 id="page-title" class="text-2xl font-bold">KEGIATAN AKTIF</h1>
                <div class="flex space-x-4">
                    <button class="text-gray-500">
                        <i class="fas fa-bell"></i>
                    </button>
                    <button class="text-gray-500">
                        <i class="fas fa-share-alt"></i>
                    </button>
                </div>
            </div>

            <!-- Buttons for switching tables -->
            <div class="flex space-x-4 mb-6">
                <button onclick="switchTable('kegiatan')" class="px-4 py-2 bg-gray-200 rounded-lg">Kegiatan</button>
                <button onclick="switchTable('donasi')" class="px-4 py-2 bg-gray-200 rounded-lg">Donasi</button>
                <button onclick="switchTable('organisasi')" class="px-4 py-2 bg-gray-200 rounded-lg">Organisasi</button>
                <button onclick="switchTable('pengguna')" class="px-4 py-2 bg-gray-200 rounded-lg">Pengguna</button>
            </div>

            <!-- Table Content -->
            <div id="kegiatan-table" class="table-content">
                @include('tables.kegiatan')
            </div>
            <div id="donasi-table" class="table-content hidden">
                @include('tables.donasi')
            </div>
            <div id="organisasi-table" class="table-content hidden">
                @include('tables.organisasi')
            </div>
            <div id="pengguna-table" class="table-content hidden">
                @include('tables.pengguna')
            </div>
        </div>
    </div>

    <script>
        function switchTable(table) {
            // Hide all tables
            document.querySelectorAll('.table-content').forEach(el => el.classList.add('hidden'));
            // Show the selected table
            document.getElementById(`${table}-table`).classList.remove('hidden');
            
            // Change the title
            const titles = {
                kegiatan: 'KEGIATAN AKTIF',
                donasi: 'DATA DONASI',
                organisasi: 'DATA ORGANISASI',
                pengguna: 'DATA PENGGUNA'
            };
            document.getElementById('page-title').textContent = titles[table];
        }
    </script>
</body>
</html>
@endsection
