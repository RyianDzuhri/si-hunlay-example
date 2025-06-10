<!-- resources/views/admin/auth/login.blade.php -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SI-Hunlay</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/auth/login.css') }}">
</head>
<body>
    <div class="container">
        <div class="container__left">
            <div class="admin-icon">⚙️</div>
            <h1>Sistem Informasi Admin SI-Hunlay</h1>
            <p>Mengelola sistem hunian layak untuk administrasi</p>
            <ul>
                <li>Kelola Data Admin</li>
                <li>Pantau Aktivitas Petugas</li>
                <li>Analisis Laporan Sistem</li>
            </ul>
        </div>
        <div class="container__right">
            <h2>Selamat Datang Di <br><strong>SI-Hunlay</strong><br><span>Panel Admin</span></h2>
            <form class="form" method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label class="form__label" for="email">Email</label>
                <input class="form__input" type="email" name="email" id="email" placeholder="Masukkan email Anda" required>
                @error('email')
                    <span class="error">{{ $message }}</span>
                @enderror

                <label class="form__label" for="password">Password</label>
                <input class="form__input" type="password" name="password" id="password" placeholder="Masukkan password Anda" required>
                @error('password')
                    <span class="error">{{ $message }}</span>
                @enderror

                {{-- <div class="form__options">
                    <label><input type="checkbox" name="remember"> Ingat saya</label>
                    <!-- <a href="{{ route('password.request') }}">Lupa Password?</a> -->
                </div> --}}

                <button class="button" type="submit">Login</button>

            </form>
        </div>
    </div>
    <script src="{{ asset('js/admin/auth/login.js') }}"></script>
</body>
</html>