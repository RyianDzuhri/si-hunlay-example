<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - SI-HUNLAY</title>
    <link href="https://fonts.googleapis.com/css2?family=Quicksand&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Quicksand', sans-serif;
        }

        body {
            background-color: #e9f2fd;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .container {
            display: flex;
            width: 900px;
            background-color: #fff;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .left {
            width: 50%;
            background-color: #1E60E1;
            color: white;
            padding: 40px;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        .left h2 {
            font-size: 20px;
            margin-bottom: 10px;
        }

        .left h1 {
            font-size: 24px;
            margin-bottom: 20px;
        }

        .left ul {
            list-style: none;
        }

        .left ul li {
            margin-bottom: 10px;
            padding-left: 24px;
            position: relative;
        }

        .left ul li::before {
            content: "✔";
            position: absolute;
            left: 0;
            color: #fff;
        }

        .right {
            width: 50%;
            padding: 40px;
            background-color: #f9f9f9;
        }

        .right h2 {
            font-size: 24px;
            margin-bottom: 20px;
            color: #1E60E1;
        }

        .right form {
            display: flex;
            flex-direction: column;
        }

        .right label {
            margin-bottom: 6px;
            font-weight: 500;
        }

        .right input[type="email"],
        .right input[type="password"] {
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
            margin-bottom: 15px;
        }

        .right .options {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .right .options label {
            display: flex;
            align-items: center;
        }

        .right .options input[type="checkbox"] {
            margin-right: 6px;
        }

        .right .options a {
            font-size: 14px;
            color: #1E60E1;
            text-decoration: none;
        }

        .right button {
            background-color: #1E60E1;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 6px;
            font-weight: bold;
            cursor: pointer;
        }

        .right .register {
            text-align: center;
            margin-top: 15px;
            font-size: 14px;
        }

        .right .register a {
            color: #1E60E1;
            text-decoration: none;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="left">
            <h1>Sistem Informasi Hunian Layak</h1>
            <p>Membantu mewujudkan hunian yang layak bagi seluruh masyarakat Indonesia</p>
            <ul>
                <li>Akses Data Hunian Terintegrasi</li>
                <li>Monitoring Program Hunian</li>
                <li>Pelaporan dan Analisis Data</li>
            </ul>
        </div>
        <div class="right">
            <h2>Selamat Datang Di <br><strong>Si-Hunlay</strong></h2>
            <form method="POST" action="{{ route('admin.login.submit') }}">
                @csrf
                <label for="email">Email</label>
                <input type="email" name="email" id="email" placeholder="Masukkan email Anda" required>

                <label for="password">Password</label>
                <input type="password" name="password" id="password" placeholder="Masukkan password Anda" required>

                <div class="options">
                    <label><input type="checkbox" name="remember"> Ingat saya</label>
                    <a href="#">Lupa Password ?</a>
                </div>

                <button type="submit">Login</button>

                <div class="register">
                    Belum memiliki akun ? <a href="#">Daftar</a>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
