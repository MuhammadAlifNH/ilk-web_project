<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Lab') }}
        </h2>
    </x-slot>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">Daftar Lab</h1>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('labs.create') }}" class="btn btn-primary mb-3">Tambah Lab</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>No</th>
                <th>Fakultas</th>
                <th>Lab</th>
                <th>Jumlah Meja</th>
                <th>Ditambahkan Oleh</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($labs as $index => $lab)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $lab->fakultas->nama_fakultas }}</td>
                    <td>{{ $lab->nama_lab }}</td>
                    <td>{{ $lab->jumlah_meja }}</td>
                    <td>{{ $lab->user->name }}</td>
                    <td>
                        <form action="{{ route('labs.destroy', $lab->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus lab '+'{{$lab->nama_lab}}'+' ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Tidak ada data lab</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
</body>
</x-app-layout>
