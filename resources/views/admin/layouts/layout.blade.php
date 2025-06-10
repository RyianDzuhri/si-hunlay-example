<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-Hunlay - Admin Panel')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
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
</head>
<body class="bg-gray-100 font-poppins">
    <div class="min-h-screen flex">
        <!-- Sidebar -->
        <aside class="w-64 bg-white shadow-md">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logoHome.png') }}" alt="Logo SI-Hunlay" class="w-8 h-8">
                    <h1 class="text-xl font-bold text-blue-700">SI-Hunlay</h1>
                </div>
            </div>
            <nav class="p-4">
                <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Menu Utama</p>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('warga/dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Dashboard.png') }}" alt="Dashboard Icon" class="w-5 h-5">
                            Dashboard
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.pengajuan') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('pengajuan-bantuan') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Detail.png') }}" alt="Pengajuan Bantuan Icon" class="w-5 h-5">
                            Pengajuan Bantuan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.penugasan') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('penugasan') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Detail.png') }}" alt="Penugasan Icon" class="w-5 h-5">
                            Penugasan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.verifikasi') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('hasil-verifikasi') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Detail.png') }}" alt="Hasil Verifikasi Icon" class="w-5 h-5">
                            Hasil Verifikasi
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.akun.pengguna') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('akun-pengguna') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Group.png') }}" alt="Akun Pengguna Icon" class="w-5 h-5">
                            Akun Pengguna
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.akun.petugas') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('akun-petugas') ? 'bg-blue-100 font-semibold' : '' }}">
                            <img src="{{ asset('images/Group.png') }}" alt="Akun Petugas Icon" class="w-5 h-5">
                            Akun Petugas
                        </a>
                    </li>
                </ul>

                <p class="text-xs text-gray-400 uppercase font-semibold mt-6 mb-2">Lainnya</p>
                <ul class="space-y-2">
                    <li>
                        <a href="{{ route('admin.bantuan') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            <img src="{{ asset('images/Bantuan.png') }}" alt="Bantuan Icon" class="w-5 h-5">
                            Bantuan
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.profile') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            <img src="{{ asset('images/Group.png') }}" alt="Profile Icon" class="w-5 h-5">
                            Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
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
            <!-- Header -->
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center">
                <h1 class="text-2xl font-semibold text-gray-800">@yield('header-title', 'SI-Hunlay - Admin Panel')</h1>
                <div class="flex items-center gap-4">
                    <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold">
                        KR
                    </div>
                    <span class="text-gray-700 font-semibold">{{ Auth::user()->name ?? 'Krisnaaaaa' }}</span>
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