<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Fakultas') }}
        </h2>
    </x-slot>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">Daftar Fakultas</h1>

        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Link untuk menambah data fakultas -->
        <a href="{{ route('fakultas.create') }}" style="background: rgb(125, 240, 125); padding: 5px;">Tambah Fakultas</a>

        <!-- Tabel data fakultas -->
        <table class="min-w-full bg-white border border-gray-300">
            <thead class="bg-gray-200">
                <tr>
                    <th class="py-2 px-4 border">No</th>
                    <th class="py-2 px-4 border">Nama Fakultas</th>
                    <th class="py-2 px-4 border">Diinput oleh</th>
                    <th class="py-2 px-4 border">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($fakultas as $index => $item)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $item->nama_fakultas }}</td>
                        <td>{{ $item->user ? $item->user->name : 'User tidak ada' }}</td>
                        <td>
                            <!-- Form untuk menghapus data -->
                            <form action="{{ route('fakultas.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus Fakultas ' + '{{ $item->nama_fakultas}}' + '?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background: rgb(255, 41, 41); padding: 5px;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center">Data fakultas tidak ada</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</x-app-layout>