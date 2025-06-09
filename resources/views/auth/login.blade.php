<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SI-Hunlay - Login</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #eaf1fb;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .container {
      display: flex;
      width: 900px;
      background-color: white;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      border-radius: 10px;
      overflow: hidden;
    }
    .left-panel {
      flex: 1;
      background-color: #2563eb;
      color: white;
      padding: 40px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }
    .left-panel h2 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .left-panel p {
      margin-bottom: 30px;
    }
    .left-panel ul {
      list-style: none;
    }
    .left-panel li::before {
      content: '✔';
      color: white;
      margin-right: 10px;
    }
    .right-panel {
      flex: 1;
      padding: 40px;
      background-color: #f9fafb;
    }
    .right-panel h1 {
      font-size: 24px;
      font-weight: 700;
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 15px;
    }
    .form-group label {
      display: block;
      font-weight: 600;
      margin-bottom: 5px;
    }
    .form-group input {
      width: 100%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .options {
      display: flex;
      justify-content: space-between;
      align-items: center;
      margin-bottom: 20px;
      font-size: 14px;
    }
    .btn {
      width: 100%;
      padding: 12px;
      background-color: #2563eb;
      color: white;
      border: none;
      border-radius: 5px;
      font-weight: 600;
      cursor: pointer;
    }
    .register {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .register a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="left-panel">
      <h2>Sistem Informasi Hunian Layak</h2>
      <p>Membantu mewujudkan hunian yang layak bagi seluruh masyarakat Indonesia</p>
      <ul>
        <li>Akses Data Hunian Terintegrasi</li>
        <li>Monitoring Program Hunian</li>
        <li>Pelaporan dan Analisis Data</li>
      </ul>
    </div>
    <div class="right-panel">
      <h1>Selamat Datang Di<br>Si-Hunlay</h1>
      <form>
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" placeholder="Masukkan email Anda">
        </div>
        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" placeholder="Masukkan password Anda">
        </div>
        <div class="options">
          <label><input type="checkbox"> Ingat saya</label>
          <a href="#">Lupa Password?</a>
        </div>
        <button type="submit" class="btn">Login</button>
        <div class="register">
          Belum memiliki akun? <a href="#">Daftar</a>
        </div>
      </form>
    </div>
  </div>
</body>
</html>
