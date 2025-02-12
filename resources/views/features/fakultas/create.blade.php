<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Kelola Fakultas') }}
        </h2>
    </x-slot>
<body>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
        <h1 class="text-3xl font-bold">Tambah Fakultas</h1>
        
        <a href="{{ route('fakultas.index') }}" style="background: yellow; padding: 5px;">Kembali</a>
    
        <!-- Tampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
    
        <!-- Form untuk menambah data fakultas -->
        <form action="{{ route('fakultas.store') }}" method="POST">
            @csrf
    
            <div class="py-2 px-4 border">
                <label for="nama_fakultas" class="form-label">Nama Fakultas</label>
                <input 
                    type="text" 
                    class="form-control @error('nama_fakultas') is-invalid @enderror" 
                    id="nama_fakultas" 
                    name="nama_fakultas" 
                    value="{{ old('nama_fakultas') }}" 
                    required
                >
    
                @error('nama_fakultas')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
    
            <button type="submit" style="background: rgb(120, 200, 253); padding: 5px;">Simpan</button>
        </form>
    </div>
</body>
</x-app-layout>