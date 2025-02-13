@extends('layouts.dashboard-layout')

@section('content')
    <div class="bg-white shadow sm:rounded-lg p-6">
        @if(Auth::user()->role === 'admin')
            <h1 class="text-3xl font-bold">Selamat datang di dashboard, Admin</h1>
            @include('admin.index')
        @elseif(Auth::user()->role === 'laboran')
            <h1 class="text-3xl font-bold">Selamat datang di dashboard, Laboran</h1>
            @include('laboran.index')
        @elseif(Auth::user()->role === 'teknisi')
            <h1 class="text-3xl font-bold">Selamat datang di dashboard, Teknisi</h1>
            @include('teknisi.index')
        @elseif(Auth::user()->role === 'pengguna')
            <h1 class="text-3xl font-bold">Selamat datang di dashboard, Pengguna</h1>
            @include('pengguna.index')
        @endif
    </div>
@endsection
