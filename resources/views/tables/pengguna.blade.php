<table class="w-full table-auto mb-6">
    <thead>
        <tr class="bg-gray-200">
            <th class="px-4 py-2">Username</th>
            <th class="px-4 py-2">Email</th>
            <th class="px-4 py-2">Jenis</th>
            <th class="px-4 py-2">Aksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($user as $user)
        <tr class="bg-white">
            <td class="border px-4 py-2">{{ $user->username }}</td>
            <td class="border px-4 py-2">{{ $user->email }}</td>
            <td class="border px-4 py-2">{{ ucfirst($user->jenis) }}</td>
            <td class="border px-4 py-2">
                <div class="flex space-x-2">
                    <a href="{{ route('user.edit', $user->id) }}" class="text-gray-500"><i class="fas fa-edit"></i>
                    </a>
                    
                    <form action="{{ route('user.destroy', $user->id) }}" method="POST" style="display: inline;">
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
