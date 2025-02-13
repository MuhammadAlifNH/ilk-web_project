<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel Dashboard') }}</title>

    <!-- Include Tailwind CSS & Alpine.js -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="//unpkg.com/alpinejs" defer></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100" x-data="{ sidebarOpen: true }">
    <!-- Topbar -->
    <header class="bg-white shadow flex items-center justify-between px-4 py-3">
        <div class="flex items-center">
            <!-- Tombol toggle sidebar untuk mobile -->
            <button @click="sidebarOpen = !sidebarOpen" class="text-gray-500 focus:outline-none md:hidden">
                <svg x-show="!sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M4 6h16M4 12h16M4 18h16"></path>
                </svg>
                <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
            <!-- Logo dan Nama Aplikasi -->
            <div class="flex items-center ml-4">
                <a href="{{ route('dashboard') }}" class="flex items-center">
        <img src="/images/logo.png" alt="Logo" class="h-12">
        <div class="ml-2">
           
        </div>
                </a>

            </div>
        </div>
        <!-- Informasi Akun Pengguna -->
        <div class="flex items-center">
            <span class="mr-2">Halo, {{ Auth::user()->name }}</span>
            <img src="{{ Auth::user()->profile_photo_url }}" alt="Profile" class="h-8 w-8 rounded-full">

        </div>
    </header>

    <div class="flex">
        <!-- Sidebar -->
        <!-- Pada layar desktop, sidebar dapat di-collapse dengan mengubah lebarnya -->
        <aside class="bg-white h-screen shadow-md transition-all duration-300 overflow-hidden"
               :class="sidebarOpen ? 'w-64' : 'w-16'">
            <!-- Header sidebar -->
            <div class="flex items-center justify-between px-4 py-3 border-b border-gray-200">
                <div x-show="sidebarOpen" class="font-bold text-lg">
                    Menu
                </div>
                <!-- Tombol toggle sidebar untuk desktop -->
                <button @click="sidebarOpen = !sidebarOpen" class="focus:outline-none hidden md:block">
                    <svg x-show="sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    <svg x-show="!sidebarOpen" class="h-6 w-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>

            <!-- Menu Sidebar -->
            <nav class="mt-4">
                <a href="{{ route('dashboard') }}"
                   class="block py-2 px-4 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                    <span x-show="sidebarOpen">Dashboard</span>
                    <span x-show="!sidebarOpen" title="Dashboard">
                        <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M3 12l2-2m0 0l7-7 7 7M13 5v6h6"></path>
                        </svg>
                    </span>
                </a>
                <a href="{{ route('profile.edit') }}"
                   class="block py-2 px-4 text-gray-700 hover:bg-gray-200 transition-colors duration-200">
                    <span x-show="sidebarOpen">Profile</span>
                    <span x-show="!sidebarOpen" title="Profile">
                        <svg class="h-5 w-5 inline-block" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M5.121 17.804A13.937 13.937 0 0112 15c2.485 0 4.847.657 6.879 1.804M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                        </svg>
                    </span>
                </a>
                <!-- Tambahkan menu lainnya sesuai kebutuhan -->
                 

            </nav>
        </aside>
    
        <!-- Konten Utama -->
        <main class="flex-1 p-6">
            @yield('content')
        </main>
    </div>
</body>
</html>
