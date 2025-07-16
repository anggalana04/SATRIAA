<table class="w-full table-auto mb-6">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Kegiatan</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Relawan</th>
            <th class="px-4 py-2">Tgl Mulai</th>
            <th class="px-4 py-2">Tgl Selesai</th>
            <th class="px-4 py-2">Progress</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($kegiatan as $item)
        <tr class="bg-white">
            <td class="border px-4 py-2">{{ $item->nama }}</td>
            <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
            <td class="border px-4 py-2">
                <div class="flex space-x-1">
                    @foreach ($item->kegiatan_detail as $relawan)
                    <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs">
                        {{ $relawan->nama }}
                    </span>
                    @endforeach
                </div>
            </td>
            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_mulai)->format('d/m/Y') }}</td>
            <td class="border px-4 py-2">{{ \Carbon\Carbon::parse($item->tanggal_selesai)->format('d/m/Y') }}</td>
            <td class="border px-4 py-2">
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-green-500 h-2.5 rounded-full" style="width: {{ round(($item->jumlah_relawan_terdaftar / $item->jumlah_relawan_dibutuhkan) * 100, 2) }}%">
                    </div>
                </div>
            </td>
            <td class="border px-4 py-2">
                <div class="flex space-x-2">
                    <a href="{{ route('kegiatan.edit', $item->id) }}" class="text-gray-500"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('kegiatan.destroy', $item->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-500"><i class="fas fa-trash"></i></button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
