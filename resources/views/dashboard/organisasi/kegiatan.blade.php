@extends('layouts.app')

@section('content')
<div class="flex-1 p-6 min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">MANAJEMEN KEGIATAN</h1>
        <div class="flex items-center space-x-4">
            <i class="fas fa-bell text-xl"></i>
            <i class="fas fa-share-alt text-xl"></i>
        </div>
    </div>

    <!-- Content Box -->
    <div class="bg-white rounded-2xl shadow-md p-6">
        <div class="flex justify-between items-center mb-4">
            <div class="flex space-x-4">
                <button class="flex items-center space-x-2 px-4 py-2 bg-gray-200 rounded-md">
                    <i class="fas fa-calendar-alt"></i>
                    <span>Timeline</span>
                </button>
                <button class="flex items-center space-x-2 px-4 py-2 bg-gray-200 rounded-md">
                    <i class="fas fa-calendar"></i>
                    <span>Kalender</span>
                </button>
            </div>
            <a href="{{ route('kegiatan.create') }}">
                <button class="px-4 py-2 bg-gray-200 rounded-md">+</button>
            </a>

            
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Kegiatan</th>
                        <th class="py-2">Relawan</th>
                        <th class="py-2">Tanggal Mulai</th>
                        <th class="py-2">Tanggal Selesai</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($kegiatan as $k)
                    <tr class="border-b bg-gray-50 rounded-lg">
                        <td class="py-2">{{ $k->nama }}</td>
                        <td class="py-2">{{ $k->jumlah_relawan_terdaftar }}</td>
                        <td class="py-2">{{ $k->tanggal_mulai }}</td>
                        <td class="py-2">{{ $k->tanggal_selesai }}</td>
                        <td class="py-2">
                            <form action="{{ route('kegiatan.updateStatus', $k->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" 
                                        class="px-2 py-1 rounded-full text-sm
                                        {{ $k->status == 'AKTIF' ? 'bg-green-200 text-green-800' : 
                                           ($k->status == 'Draft' ? 'bg-yellow-200 text-yellow-800' : 
                                           'bg-blue-200 text-blue-800') }}">
                                    <option value="pending" {{ $k->status == 'pending' ? 'selected' : '' }}>pending</option>
                                    <option value="aktif" {{ $k->status == 'aktif' ? 'selected' : '' }}>aktif</option>
                                    <option value="selesai" {{ $k->status == 'selesai' ? 'selected' : '' }}>selesai</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-2 flex space-x-2">
                            <a href="{{ route('kegiatan.show', $k->id) }}" class="text-gray-600"><i class="fas fa-search"></i></a>
                            <a href="{{ route('kegiatan.edit', $k->id) }}" class="text-gray-600"><i class="fas fa-pen"></i></a>
                            <form action="{{ route('kegiatan.destroy', $k->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-600" onclick="return confirm('Apakah Anda yakin ingin menghapus kegiatan ini?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection