<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <style>            
            .tombol {
              top: 10px;           /* Jarak dari atas kontainer */
              left: 10px;          /* Jarak dari kiri kontainer */
              background-color: #3baa9b; /* Warna hijau */
              color: white;
              padding: 10px 20px;  /* Lebar dan tinggi tombol */
              border: none;
              border-radius: 2px;
              cursor: pointer;
              z-index: 2; /* Nilai z-index lebih tinggi sehingga berada di atas teks */
              transition: background-color 0.3s ease;
            }
            
            /* Efek hover untuk tombol */
            .tombol:hover {
              background-color: #458ba0;
            }
          </style>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
