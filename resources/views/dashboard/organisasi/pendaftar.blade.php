@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold mb-6">Manajemen Pendaftar</h1>

    {{-- Error and Success Messages --}}
    @if(session('success'))
        <div class="alert bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">&times;</button>
        </div>
    @endif

    @if(session('error'))
        <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
            <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">&times;</button>
        </div>
    @endif

    @if($errors->any())
        <div class="alert bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button onclick="this.parentElement.style.display='none'" class="absolute top-0 bottom-0 right-0 px-4 py-3">&times;</button>
        </div>
    @endif

    <div class="overflow-x-auto">
        <table class="table-auto w-full border-collapse border border-gray-300">
            <thead>
                <tr class="bg-gray-200">
                    <th class="border border-gray-300 px-4 py-2">id Kegiatan</th>
                    <th class="border border-gray-300 px-4 py-2">id User</th>
                    <th class="border border-gray-300 px-4 py-2">Alasan</th>
                    <th class="border border-gray-300 px-4 py-2">Status</th>
                    <th class="border border-gray-300 px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pendaftar as $item)
                <tr class="hover:bg-gray-100">
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('kegiatan.show', $item->kegiatan_id) }}">{{ $item->kegiatan_id ?? 'Kegiatan tidak ditemukan' }}</a>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <a href="{{ route('profil_relawan.show', $item->user_id) }}">{{ $item->user_id ?? 'User tidak ditemukan' }}</a>
                    </td>
                                        <td class="border border-gray-300 px-4 py-2">{{ $item->alasan }}</td>
                    <td class="border border-gray-300 px-4 py-2">
                        <span class="px-2 py-1 rounded-full text-white 
                            @if($item->status === 'onreview') bg-yellow-500 
                            @elseif($item->status === 'diterima') bg-green-500 
                            @else bg-red-500 @endif">
                            {{ ucfirst($item->status) }}
                        </span>
                    </td>
                    <td class="border border-gray-300 px-4 py-2">
                        <form action="{{ route('update.status', $item->id) }}" method="POST" id="statusForm{{ $item->id }}">
                            @csrf
                            <select name="status" class="rounded border-gray-300" onchange="document.getElementById('statusForm{{ $item->id }}').submit()">
                                <option value="onreview" {{ $item->status == 'onreview' ? 'selected' : '' }}>On Review</option>
                                <option value="diterima" {{ $item->status == 'diterima' ? 'selected' : '' }}>Diterima</option>
                                <option value="ditolak" {{ $item->status == 'ditolak' ? 'selected' : '' }}>Ditolak</option>
                            </select>
                        </form>

                        <form action="{{ route('daftar.destroy', $item->id) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-700"
                                onclick="return confirm('Apakah Anda yakin ingin menghapus data ini?')">&#128465;</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script>
    // Auto-hide alerts after 5 seconds
    setTimeout(() => {
        const alerts = document.querySelectorAll('.alert');
        alerts.forEach(alert => alert.style.display = 'none');
    }, 5000);
</script>
@endsection
