<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-Hunlay')</title> {{-- Judul dinamis --}}
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Google Fonts Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            /* Font Poppins diterapkan melalui Tailwind config dan class pada body */
            background-color: #f3f4f6; /* Warna latar belakang umum */
        }
    </style>
    <script>
        // Konfigurasi Tailwind CSS untuk menambahkan font Poppins
        tailwind.config = {
            theme: {
                extend: {
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    @stack('styles') {{-- Untuk style tambahan dari child views --}}
</head>
<body class="bg-gray-100 font-poppins">

    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-6 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logoHome.png') }}" alt="Logo SI-Hunlay" class="w-8 h-8">
                    <h1 class="text-xl font-bold text-blue-700">SI-Hunlay</h1>
                </div>
            </div>
            
            <nav class="p-4">
                <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Menu Utama</p>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('petugas.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Dashboard.png') }}" alt="Dashboard Icon" class="w-5 h-5">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('petugas.tugas') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('daftar-tugas') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Detail.png') }}" alt="Daftar Tugas Icon" class="w-5 h-5">
                            Daftar Tugas
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('verifikasi-lapangan') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/petugas.png') }}" alt="Ajukan Bantuan" class="w-5 h-5">
                            Ajukan Bantuan
                        </a>
                    </li>
                </ul>

                <p class="text-xs text-gray-400 uppercase font-semibold mt-6 mb-2">Lainnya</p>
                <ul class="space-y-2">
                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            <img src="{{ asset('images/Bantuan.png') }}" alt="Bantuan Icon" class="w-5 h-5">
                            Bantuan
                        </a>
                    </li>
                    <li>
                        <a href="#" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            <img src="{{ asset('images/Group.png') }}" alt="Profile Icon" class="w-5 h-5">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form method="GET" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                                <img src="{{ asset('images/Out.png') }}" alt="Keluar Icon" class="w-5 h-5">
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col">
            <!-- HEADER DI DALAM MAIN CONTENT (Diperbarui) -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                {{-- Judul Panel di sisi kiri --}}
                <div class="text-xl font-semibold text-gray-800">
                    SI-Hunlay - Petugas Panel
                </div>

                {{-- Ikon Notifikasi dan Profil Pengguna di sisi kanan --}}
                <div class="flex items-center space-x-4">

                    {{-- Profil Pengguna --}}
                    <div class="flex items-center space-x-2 cursor-pointer">
                        <div class="bg-blue-500 text-white rounded-full h-8 w-8 flex items-center justify-center font-bold text-sm">
                            KR {{-- Inisial Nama User, contoh KR untuk Krisna --}}
                        </div>
                        <span class="text-gray-800 font-medium">Krisnaaaaa</span> {{-- Nama User --}}
                        {{-- Ikon panah dropdown --}}
                        <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
            </header>

            <!-- Page Content -->
            <main class="p-6">
                @yield('content')
            </main>
        </div>
    </div>

</body>
</html>