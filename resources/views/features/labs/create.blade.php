<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Lab') }}
        </h2>
    </x-slot>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">Tambah Lab</h1>

    <form action="{{ route('labs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="fakultas_id" class="form-label">Fakultas</label>
            <select name="fakultas_id" id="fakultas_id" class="form-control">
                @foreach($fakultas as $f)
                    <option value="{{ $f->id }}">{{ $f->nama_fakultas }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="nama_lab" class="form-label">Nama Lab</label>
            <input type="text" name="nama_lab" id="nama_lab" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="jumlah_meja" class="form-label">Jumlah Meja</label>
            <input type="number" name="jumlah_meja" id="jumlah_meja" class="form-control" min="1" required>
        </div>

        <button type="submit" class="btn btn-primary">Simpan</button>
    </form>
</div>
</body>
</x-app-layout>
