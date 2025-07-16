<table class="w-full table-auto mb-6">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Donasi</th>
            <th class="px-4 py-2">Deskripsi</th>
            <th class="px-4 py-2">Target</th>
            <th class="px-4 py-2">Terkumpul</th>
            <th class="px-4 py-2">Status</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($donasi as $item)
        <tr class="bg-white">
            <td class="border px-4 py-2">{{ $item->nama }}</td>
            <td class="border px-4 py-2">{{ $item->deskripsi }}</td>
            <td class="border px-4 py-2">Rp {{ number_format($item->target_donasi, 0, ',', '.') }}</td>
            <td class="border px-4 py-2">Rp {{ number_format($item->jumlah_donasi, 0, ',', '.') }}</td>
            <td class="border px-4 py-2">{{ ucfirst($item->status) }}</td>
            <td class="border px-4 py-2">
                <div class="flex space-x-2">
                    <a href="{{ route('donasi.edit', $item->id) }}" class="text-gray-500"><i class="fas fa-edit"></i></a>
                    <form action="{{ route('donasi.destroy', $item->id) }}" method="POST">
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
