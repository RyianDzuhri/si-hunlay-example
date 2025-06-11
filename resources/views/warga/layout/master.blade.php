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
      
      <!-- ... Bagian atas tetap sama ... -->
        <nav class="p-4">
          <p class="text-xs text-gray-400 uppercase font-semibold mb-2">Menu Utama</p>
          <ul class="space-y-2">
            <li>
              <a href="{{ route('warga.dashboard') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-blue-100 font-semibold' : '' }}">
                <img src="{{ asset('images/Dashboard.png') }}" alt="Dashboard Icon" class="w-5 h-5">
                Dashboard
              </a>
            </li>
            <li>
              <a href="{{ route('warga.pengajuan') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('pengajuan-saya') ? 'bg-blue-100 font-semibold' : '' }}">
                <img src="{{ asset('images/Detail.png') }}" alt="Pengajuan Saya Icon" class="w-5 h-5">
                Pengajuan Saya
              </a>
            </li>
            <li>
              <a href="{{ route('warga.progress') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg {{ request()->is('progress-pengajuan') ? 'bg-blue-100 font-semibold' : '' }}">
                <img src="{{ asset('images/Detail.png') }}" alt="Progress Pengajuan Icon" class="w-5 h-5">
                Progress Pengajuan
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
              <a href="{{ route('warga.profile') }}" class="flex items-center gap-2 text-gray-700 hover:bg-blue-100 px-3 py-2 rounded-lg">
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
      <header class="bg-white shadow-sm px-6 py-4 flex justify-end items-center">
        <div class="flex items-center gap-4">
          <div class="bg-blue-600 text-white rounded-full w-8 h-8 flex items-center justify-center font-semibold">
            KR
          </div>
          <span class="text-gray-700 font-semibold">Ryian Dzuhri</span>
        </div>
      </header>

      <!-- Page Content -->
      <main class="p-6">
        @yield('content')
      </main>
    </div>
  </div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
