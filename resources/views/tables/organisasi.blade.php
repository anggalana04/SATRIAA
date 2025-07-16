<table class="w-full table-auto mb-6">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Nama Organisasi</th>
            <th class="px-4 py-2">Alamat</th>
            <th class="px-4 py-2">Ketua</th>
            <th class="px-4 py-2">Kategori</th>
            <th class="px-4 py-2">Visi</th>
            <th class="px-4 py-2">Misi</th>
            <th class="px-4 py-2">Rating</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">WA</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($organisasi as $org)
        <tr class="bg-white">
            <td class="border px-4 py-2">{{ $org->nama }}</td>
            <td class="border px-4 py-2">{{ $org->alamat }}</td>
            <td class="border px-4 py-2">{{ $org->ketua }}</td>
            <td class="border px-4 py-2">{{ $org->kategori }}</td>
            <td class="border px-4 py-2">{{ $org->visi }}</td>
            <td class="border px-4 py-2">{{ $org->misi }}</td>
            <td class="border px-4 py-2">{{ $org->rating }}</td>
            <td class="border px-4 py-2">{{ $org->email }}</td>
            <td class="border px-4 py-2">{{ $org->wa }}</td>
            <td class="border px-4 py-2">
                <div class="flex space-x-2">
                    <!-- Tombol Edit -->
                    <a href="{{ route('organisasi.edit', $org->id) }}" class="text-gray-500">
                        <i class="fas fa-edit"></i>
                    </a>
                    <!-- Form Delete -->
                    <form action="{{ route('organisasi.destroy', $org->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-gray-500">
                            <i class="fas fa-trash"></i>
                        </button>
                    </form>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
