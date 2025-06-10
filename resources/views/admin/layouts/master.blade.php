<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>@yield('title', 'Dashboard Admin - SI-Hunlay')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('css/admin/auth/login.css') }}" />
    <style>
        body, html {
            margin: 0; padding: 0; font-family: 'Poppins', sans-serif; background: #f5f7fa;
        }
        .dashboard {
            display: flex;
            height: 100vh;
            background: #f5f7fa;
        }
        .sidebar {
            width: 250px;
            background: #fff;
            padding: 20px;
            border-right: 1px solid #e0e0e0;
        }
        .sidebar h2 {
            font-size: 18px;
            font-weight: 600;
            margin-bottom: 20px;
            color: #1E60E1;
        }
        .sidebar ul {
            list-style: none;
            padding-left: 0;
        }
        .sidebar ul li {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 5px;
            color: #333;
        }
        .sidebar ul li.active {
            background: #e9f2fd;
            color: #1E60E1;
        }
        .sidebar ul li a {
            text-decoration: none;
            color: inherit;
        }
        .main-content {
            flex: 1;
            padding: 20px;
            overflow-y: auto;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            font-weight: 600;
            color: #1E60E1;
        }
        .header .user-info {
            display: flex;
            align-items: center;
        }
        .header .user-info span {
            margin-right: 10px;
            font-weight: 500;
        }
        /* Tambahan styling untuk footer agar konsisten */
        .footer {
            text-align: center;
            font-size: 12px;
            color: #666;
            margin-top: 20px;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="dashboard">
        <aside class="sidebar">
            <h2>🏠 <span style="color: #1E60E1;">SI-Hunlay</span></h2>
            <ul>
                <li class="{{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"><a href="#">Dashboard</a></li>
                <li class="{{ request()->routeIs('admin.pengajuan') ? 'active' : '' }}"><a href="#">Pengajuan Bantuan</a></li>
                <li class="{{ request()->routeIs('admin.penugasan') ? 'active' : '' }}"><a href="#">Penugasan</a></li>
                <li class="{{ request()->routeIs('admin.verifikasi') ? 'active' : '' }}"><a href="#">Hasil Verifikasi</a></li>
                <li class="{{ request()->routeIs('admin.user.*') ? 'active' : '' }}"><a href="#">Akun Pengguna</a></li>
                <li class="{{ request()->routeIs('admin.petugas.*') ? 'active' : '' }}"><a href="#">Akun Petugas</a></li>
                <li class="{{ request()->routeIs('admin.bantuan') ? 'active' : '' }}"><a href="#">Bantuan</a></li>
                <li class="{{ request()->routeIs('admin.profile') ? 'active' : '' }}"><a href="#">Profil</a></li>
                <li>
                    <form action="{{ route('logout') }}" method="GET" style="margin:0;">
                        @csrf
                        <button type="submit" style="background:none;border:none;color:#d00;cursor:pointer;padding:0;">Keluar</button>
                    </form>
                </li>
            </ul>
        </aside>

        <main class="main-content">
            <header class="header">
                <h1>@yield('header-title', 'Selamat Datang, Admin')</h1>
                <div class="user-info">
                    <span>{{ Auth::user()->name ?? 'Admin' }}</span>
                    <button title="Cari">🔍</button>
                </div>
            </header>

            @yield('content')

            <footer class="footer">
                © 2025 SI-Hunlay Kota Kendari. Hak Cipta Dilindungi. | <a href="#">Bantuan</a> | <a href="#">Kebijakan Privasi</a> | <a href="#">Syarat & Ketentuan</a>
            </footer>
        </main>
    </div>
    @stack('scripts')
</body>
</html>
