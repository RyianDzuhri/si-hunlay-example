<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Daftar Akun - SI-Hunlay</title>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }
    body {
      background-color: #f3f6fc;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      padding: 20px; /* supaya ada space di layar kecil */
    }
    .register-container {
      background-color: white;
      padding: 40px;
      width: 420px;
      max-width: 100%;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }
    .register-container h2 {
      font-size: 22px;
      font-weight: 700;
      margin-bottom: 10px;
    }
    .register-container p {
      font-size: 14px;
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
      font-size: 14px;
    }
    .checkbox-group {
      display: flex;
      align-items: center;
      font-size: 14px;
      margin-bottom: 20px;
    }
    .checkbox-group input {
      margin-right: 8px;
    }
    .checkbox-group a {
      color: #2563eb;
      text-decoration: none;
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
      font-size: 14px;
    }
    .login-link {
      text-align: center;
      margin-top: 15px;
      font-size: 14px;
    }
    .login-link a {
      color: #2563eb;
      text-decoration: none;
      font-weight: 600;
    }

    /* Responsif untuk layar kecil */
    @media (max-width: 480px) {
      .register-container {
        padding: 20px;
        width: 90vw; /* supaya di layar kecil container tidak terlalu besar */
        border-radius: 8px;
      }
      .register-container h2 {
        font-size: 20px;
      }
      .register-container p {
        font-size: 13px;
        margin-bottom: 15px;
      }
      .form-group input {
        font-size: 13px;
        padding: 8px;
      }
      .btn {
        padding: 10px;
        font-size: 13px;
      }
    }
  </style>
</head>
<body>
  <div class="register-container">
    <h2>Daftar Akun</h2>
    <p>Lengkapi informasi berikut ini untuk mendaftar dan mengajukan bantuan RTLH</p>
    <form>
      <div class="form-group">
        <label for="nama">Nama Lengkap</label>
        <input type="text" id="nama" placeholder="Masukkan nama lengkap">
      </div>
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" placeholder="contoh@gmail.com">
      </div>
      <div class="form-group">
        <label for="nik">NIK</label>
        <input type="text" id="nik" placeholder="16 digit NIK" maxlength="16">
      </div>
      <div class="form-group">
        <label for="nohp">No HP</label>
        <input type="text" id="nohp" placeholder="16 digit NIK">
      </div>
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" placeholder="Minimal 8 karakter">
      </div>
      <div class="form-group">
        <label for="konfirmasi-password">Konfirmasi Password</label>
        <input type="password" id="konfirmasi-password" placeholder="Ulangi Password">
      </div>
      <div class="checkbox-group">
        <input type="checkbox" id="syarat">
        <label for="syarat">Saya menyetujui <a href="#">syarat dan ketentuan</a></label>
      </div>
      <button type="submit" class="btn">Daftar</button>
    </form>
    <div class="login-link">
      Sudah punya akun? <a href="#">Login</a>
    </div>
  </div>
</body>
</html>
