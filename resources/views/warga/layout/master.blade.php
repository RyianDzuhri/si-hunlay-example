<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>@yield('title', 'Default Title')</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css"/>

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

  <style>
    html { scroll-behavior: smooth; }
  </style>
</head>
<body class="bg-gray-100 font-poppins min-h-screen flex">

  {{-- SIDEBAR --}}
  <div id="sidebar" class="bg-white w-64 shadow-md fixed inset-y-0 left-0 z-30 transform -translate-x-full md:translate-x-0 transition-transform duration-300 ease-in-out">
    <div class="p-6 border-b border-gray-200 flex items-center gap-2">
      <img src="{{ asset('images/logoHome.png') }}" alt="Logo" class="w-8 h-8">
      <h1 class="text-xl font-bold text-blue-700">SI-Hunlay</h1>
    </div>

    <nav class="p-4 overflow-y-auto max-h-[calc(100vh-80px)]">
      <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Menu Utama</p>
      <ul class="space-y-2">
        <li>
          <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
            <img src="{{ asset('images/Dashboard.png') }}" class="w-5 h-5"> Dashboard
          </a>
        </li>
        <li>
          <a href="{{ route('warga.pengajuan') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('pengajuan-saya') ? 'bg-blue-100 font-semibold' : '' }}">
            <img src="{{ asset('images/Detail.png') }}" class="w-5 h-5"> Pengajuan Saya
          </a>
        </li>
        <li>
          <a href="{{ route('warga.progress') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('progress-pengajuan') ? 'bg-blue-100 font-semibold' : '' }}">
            <img src="{{ asset('images/Detail.png') }}" class="w-5 h-5"> Progress Pengajuan
          </a>
        </li>
      </ul>

      <p class="text-xs text-gray-400 uppercase font-semibold mt-6 mb-2">Lainnya</p>
      <ul class="space-y-2">
        <li>
          <a href="{{ route('warga.profil') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
            <img src="{{ asset('images/Group.png') }}" class="w-5 h-5"> Profil
          </a>
        </li>
        <li>
          <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="flex items-center gap-2 w-full text-left text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
              <img src="{{ asset('images/Out.png') }}" class="w-5 h-5"> Keluar
            </button>
          </form>
        </li>
      </ul>
    </nav>
  </div>

  {{-- MAIN WRAPPER --}}
  <div class="flex-1 flex flex-col min-h-screen md:ml-64">

    {{-- HEADER --}}
    <header class="bg-white shadow-sm px-4 py-4 flex items-center justify-between sticky top-0 z-20">
      {{-- HAMBURGER --}}
      <button id="toggleSidebar" class="md:hidden text-gray-600 focus:outline-none">
        <i class="fas fa-bars fa-lg"></i>
      </button>

      {{-- USER INFO --}}
      <div class="flex items-center gap-4 ml-auto">
        <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold">
          {{ strtoupper(Str::substr($user->nama, 0, 1)) }}
        </div>
        <span class="text-gray-700 font-semibold text-sm md:text-base">{{ $user->nama }}</span>
      </div>
    </header>

    {{-- PAGE CONTENT --}}
    <main class="p-4 md:px-8 flex-1 overflow-y-auto max-w-screen-lg w-full mx-auto">
      @yield('content')
    </main>

  </div>

  {{-- SCRIPT TOGGLE SIDEBAR --}}
  <script>
    const toggleBtn = document.getElementById('toggleSidebar');
    const sidebar = document.getElementById('sidebar');

    toggleBtn.addEventListener('click', () => {
      sidebar.classList.toggle('-translate-x-full');
    });
  </script>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
