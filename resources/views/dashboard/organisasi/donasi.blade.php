@extends('layouts.app')

@section('content')
<div class="flex-1 p-6 min-h-screen bg-gray-100">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">MANAJEMEN DONASI</h1>
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
            <a href="{{ route('donasi.create') }}">
                <button class="px-4 py-2 bg-gray-200 rounded-md">+</button>
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-separate border-spacing-y-2">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Nama</th>
                        <th class="py-2">Deskripsi</th>
                        <th class="py-2">Tanggal Mulai</th>
                        <th class="py-2">Tanggal Selesai</th>
                        <th class="py-2">Status</th>
                        <th class="py-2">Dana Terkumpul</th>
                        <th class="py-2">Target</th>
                        <th class="py-2">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($donasi as $d)
                    <tr class="border-b bg-gray-50 rounded-lg">
                        <td class="py-2">{{ $d->nama }}</td>
                        <td class="py-2">{{ $d->deskripsi }}</td>
                        <td class="py-2">{{ $d->tanggal_mulai }}</td>
                        <td class="py-2">{{ $d->tanggal_selesai }}</td>
                        <td class="py-2">
                            <form action="{{ route('donasi.updateStatus', $d->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <select name="status" onchange="this.form.submit()" class="px-2 py-1 rounded-full text-sm 
                                    {{ $d->status == 'aktif' ? 'bg-green-200 text-green-800' : 
                                       ($d->status == 'pending' ? 'bg-yellow-200 text-yellow-800' : 
                                       'bg-blue-200 text-blue-800') }}">
                                    <option value="pending" {{ $d->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                    <option value="aktif" {{ $d->status == 'aktif' ? 'selected' : '' }}>Aktif</option>
                                    <option value="selesai" {{ $d->status == 'selesai' ? 'selected' : '' }}>Selesai</option>
                                </select>
                            </form>
                        </td>
                        <td class="py-2">Rp {{ number_format($d->jumlah_donasi, 2) }}</td>
                        <td class="py-2">
                            <div class="progress-bar relative w-full bg-gray-200 rounded-full h-4">
                                <div class="absolute top-0 left-0 h-full bg-blue-500 rounded-full" 
                                     style="width: {{ ($d->jumlah_donasi / $d->target_donasi) * 100 }}%">
                                </div>
                                <div class="absolute top-0 left-0 w-full h-full flex justify-between items-center px-2 text-xs text-white">
                                    <span>{{ number_format(($d->jumlah_donasi / $d->target_donasi) * 100, 2) }}%</span>
                                    <span>Rp {{ number_format($d->target_donasi, 2) }}</span>
                                </div>
                            </div>
                        </td>
                        <td class="py-2 flex space-x-2">
                            <a href="{{ route('donasi.show', $d->id) }}" class="text-gray-600">
                                <i class="fas fa-search"></i>
                            </a>
                            <a href="{{ route('donasi.edit', $d->id) }}" class="text-gray-600">
                                <i class="fas fa-pen"></i>
                            </a>
                            <form action="{{ route('donasi.destroy', $d->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-gray-600" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus donasi ini?')">
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