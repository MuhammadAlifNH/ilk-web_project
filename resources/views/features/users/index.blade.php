<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Pengguna') }}
        </h2>
    </x-slot>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">Daftar Pengguna</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <table class="min-w-full bg-white border border-gray-300">
        <thead  class="bg-gray-200">
            <tr>
                <th class="py-2 px-4 border">No</th>
                <th class="py-2 px-4 border">Foto</th>
                <th class="py-2 px-4 border">Nama</th>
                <th class="py-2 px-4 border">Email</th>
                <th class="py-2 px-4 border">No. Telepone</th>
                <th class="py-2 px-4 border">Role</th>
                <th class="py-2 px-4 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($users as $index => $user)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>
                        <img src="{{ $user->profile_photo_url }}" alt="{{ $user->name }}" class="img-thumbnail" width="100">
                    </td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->phone}}</td>
                    <td>{{ $user->role }}</td>
                    <td>
                        <a href="{{ route('users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit Role</a>
                        
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;" onsubmit="return confirm('Yakin ingin menghapus user '+'{{$user->name}}'+'ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Tidak ada data user</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</x-app-layout>
