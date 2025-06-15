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
    <div class="flex min-h-screen">
        <aside class="w-64 bg-white shadow-md fixed inset-y-0 left-0 z-10">
            <div class="p-4 border-b border-gray-200">
                <div class="flex items-center gap-2">
                    <img src="{{ asset('images/logoHome.png') }}" alt="Logo SI-Hunlay" class="w-8 h-8">
                    <h1 class="text-xl font-bold text-blue-700">SI-Hunlay</h1>
                </div>
            </div>
            <nav class="p-4 overflow-y-auto h-[calc(100vh-64px)]">
                <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Menu Utama</p>
                <ul class="space-y-2">
                    <li>
                        {{-- Dashboard --}}
                        <a href="{{ route('warga.dashboard') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('warga/dashboard') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1H11m-4 0a1 1 0 001-1V9.414a1 1 0 00-.293-.707l-2-2.007V5a1 1 0 011-1h10a1 1 0 011 1v14a1 1 0 01-1 1h-3M7 21h10"></path></svg>
                            Dashboard
                        </a>
                    </li>
                    <li>
                        {{-- Pengajuan Bantuan (Docs/File Icon) --}}
                        <a href="{{ route('admin.pengajuan.index') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/pengajuan-bantuan') || request()->is('admin/pengajuan-bantuan/*') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                            Pengajuan Bantuan
                        </a>
                    </li>
                    <li>
                        {{-- Penugasan (Clipboard List Icon) --}}
                        <a href="{{ route('admin.penugasan.index') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/penugasan') || request()->is('admin/penugasan/*') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                            Penugasan
                        </a>
                    </li>
                    <li>
                        {{-- Hasil Verifikasi (Document Check/Search Icon) --}}
                        <a href="{{ route('admin.verifikasi.index') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/verifikasi') || request()->is('admin/verifikasi/*') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2m-3 10l-3-3m0 0l-3 3m3-3v6m7-11l3 3m0 0l-3-3m3 3V5"></path></svg>
                            Hasil Verifikasi
                        </a>
                    </li>
                    <li>
                        {{-- Akun Pengguna (Users Icon) --}}
                        <a href="{{ route('admin.pengguna.index') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/akun/pengguna') || request()->is('admin/akun/pengguna/*') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20h2a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h2"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20h2"></path></svg>
                            Akun Pengguna
                        </a>
                    </li>
                    <li>
                        {{-- Akun Petugas (User Group Icon) --}}
                        <a href="{{ route('admin.akun.petugas.index') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/akun/petugas') || request()->is('admin/akun/petugas/*') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20h2a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h2"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20h2"></path></svg>
                            Akun Petugas
                        </a>
                    </li>
                </ul>

                <p class="text-xs text-gray-400 uppercase font-semibold mt-6 mb-2">Lainnya</p>
                <ul class="space-y-2">
                    <li>
                        {{-- Bantuan (Information Circle Icon) --}}
                        <a href="{{ route('admin.bantuan') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/bantuan') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Bantuan
                        </a>
                    </li>
                    <li>
                        {{-- Profile (User Circle Icon) --}}
                        <a href="{{ route('admin.profile') }}"
                           class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg
                                  {{ request()->is('admin/profile') ? 'bg-blue-100 font-semibold text-blue-700' : '' }}">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 0a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            Profile
                        </a>
                    </li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="flex items-center gap-2 w-full text-left text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                                {{-- Logout (Arrow Right on Rectangle Icon) --}}
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"></path></svg>
                                Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </aside>

        <div class="flex-1 ml-64 flex flex-col min-h-screen">
            <header class="bg-white shadow-sm px-6 py-4 flex justify-between items-center sticky top-0 z-10">
                <h1 class="text-2xl font-semibold text-gray-800">@yield('header-title', 'SI-Hunlay - Admin Panel')</h1>
                <div class="flex items-center gap-4">
                    <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold">
                        KR
                    </div>
                    <span class="text-gray-700 font-semibold flex items-center gap-1">
                        {{ Auth::user()->name ?? 'Krisnaaaaa' }}
                        <img src="{{ asset('images/arrow-ios-back.png') }}" alt="Chevron Down" class="w-4 h-4">
                    </span>
                </div>
            </header>

            <main class="p-6 overflow-y-auto flex-1">
                @yield('content')
            </main>

            <footer class="bg-white shadow-sm px-6 py-4 text-center text-sm text-gray-500">
                &copy; {{ date('Y') }} SI-Hunlay. Seluruh hak cipta dilindungi.
            </footer>
        </div>
    </div>
</body>
</html>