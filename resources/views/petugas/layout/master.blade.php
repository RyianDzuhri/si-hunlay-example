<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'SI-Hunlay')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            background-color: #f3f4f6;
        }
    </style>
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
    @stack('styles')
</head>
<body class="bg-gray-100 font-poppins h-screen overflow-hidden" x-data="{ sidebarOpen: false }">

    <!-- [FIX] Latar belakang overlay saat sidebar terbuka di mobile -->
    <div x-show="sidebarOpen"
         x-transition:enter="transition ease-out duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-100"
         x-transition:leave="transition ease-in duration-200"
         x-transition:leave-start="opacity-100"
         x-transition:leave-end="opacity-0"
         @click="sidebarOpen = false"
         class="fixed inset-0 bg-black bg-opacity-50 z-20 md:hidden"
         aria-hidden="true"
    ></div>

    {{-- SIDEBAR RESPONSIVE --}}
    <aside
        class="bg-white shadow-md fixed inset-y-0 left-0 z-30 w-64 transform transition-transform duration-300 md:translate-x-0"
        :class="{ '-translate-x-full': !sidebarOpen }"
        {{-- [FIX] Hapus @click.outside dari sini --}}
    >
        <div class="p-6 border-b border-gray-200 flex items-center gap-2">
            <img src="{{ asset('images/logoHome.png') }}" alt="Logo SI-Hunlay" class="w-8 h-8">
            <h1 class="text-xl font-bold text-blue-700">SI-Hunlay</h1>
        </div>
        <nav class="p-4 overflow-y-auto h-[calc(100%-80px)]">
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
            </ul>

            <p class="text-xs text-gray-400 uppercase font-semibold mt-6 mb-2">Lainnya</p>
            <ul class="space-y-2">
                <li>
                    <a href="#" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                        <img src="{{ asset('images/Bantuan.png') }}" class="w-5 h-5"> Bantuan
                    </a>
                </li>
                <li>
                    <a href="#" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                        <img src="{{ asset('images/Group.png') }}" class="w-5 h-5"> Profile
                    </a>
                </li>
                <li>
                    <form method="GET" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full text-left text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
                            <img src="{{ asset('images/Out.png') }}" class="w-5 h-5"> Keluar
                        </button>
                    </form>
                </li>
            </ul>
        </nav>
    </aside>

    {{-- MAIN CONTENT --}}
    <div class="md:ml-64 flex flex-col h-screen">

        {{-- HEADER --}}
        <header class="bg-white shadow-sm px-4 py-4 flex justify-between items-center fixed top-0 left-0 right-0 z-20 md:left-64 md:pl-6 md:pr-6 h-16">
            <div class="flex items-center gap-4">
                {{-- Hamburger --}}
                <button class="md:hidden text-gray-600 focus:outline-none" @click="sidebarOpen = !sidebarOpen">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 6h16M4 12h16M4 18h16"/>
                    </svg>
                </button>
                <span class="text-xl font-semibold text-gray-800 hidden md:block">SI-Hunlay - Petugas Panel</span>
            </div>
            <div class="flex items-center space-x-2 cursor-pointer">
                @php
                    use Illuminate\Support\Str;
                    $user = Auth::user();
                @endphp
                <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold">
                    {{ strtoupper(Str::substr($user->nama, 0, 1)) }}
                </div>
                <span class="text-gray-700 font-semibold text-sm md:text-base">{{ $user->nama }}</span>
                <svg class="w-4 h-4 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M19 9l-7 7-7-7"/>
                </svg>
            </div>
        </header>

        {{-- MAIN PAGE --}}
        <main class="mt-16 p-4 overflow-y-auto flex-1">
            @yield('content')
        </main>
    </div>

</body>
</html>
