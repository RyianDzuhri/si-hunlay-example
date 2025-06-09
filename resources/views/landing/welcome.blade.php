<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>SI-Hunlay Kota Kendari</title>
  
  <!-- Import Google Fonts Poppins -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet" />
  
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    // Override default Tailwind font family with Poppins
    tailwind.config = {
      theme: {
        extend: {
          fontFamily: {
            sans: ['Poppins', 'ui-sans-serif', 'system-ui', 'sans-serif'],
          },
        },
      },
    }
  </script>
</head>
<body class="bg-white text-gray-800 font-sans">
  <!-- Navbar -->
  <header class="bg-white shadow-sm">
    <div class="max-w-7xl mx-auto px-4 py-4 flex items-center">
      <!-- Placeholder Logo -->
      <div class="flex items-center space-x-2">
          <a href="{{ url('/') }}" class="flex items-center space-x-2">
              <img src="{{ asset('images/logoHome.png') }}" alt="Logo" class="h-8 w-auto">
              <div class="text-2xl font-bold text-blue-600">SI-Hunlay</div>
          </a>
      </div>
      <!-- Menu: Digeser ke kanan dengan ml-auto -->
      <nav class="hidden md:flex ml-auto space-x-6 text-sm font-medium">
        <a href="{{ url('/') }}" class="text-gray-600 hover:text-blue-600">Beranda</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Tentang</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Cara Kerja</a>
        <a href="#" class="text-gray-600 hover:text-blue-600">Bantuan</a>
        <a href="{{ route('auth.login') }}" class="text-blue-600 no-underline hover:text-blue-700">Masuk</a>
      </nav>
      <!-- Tombol Daftar -->
      <a href="{{ route('auth.register') }}" class="hidden md:inline-block bg-blue-600 text-white px-4 py-2 ml-6 rounded-md text-sm font-semibold hover:bg-blue-700">
        Daftar Sekarang
      </a>
    </div>
  </header>
  <section class="bg-blue-50 py-20">
      <div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row items-center justify-between gap-x-16">
          <!-- Konten Kiri -->
          <div class="w-full md:w-1/2 px-6 flex flex-col justify-center items-start">
              <h1 class="text-3xl md:text-5xl font-extrabold text-gray-900 mb-4">
                  Selamat Datang di <span class="block md:inline">SI-Hunlay Kota Kendari</span>
              </h1>
              <p class="text-gray-700 text-base md:text-lg mb-6">
                  Sistem Informasi Hunian Layak untuk mendukung masyarakat mendapatkan bantuan RTLH
              </p>
              <div class="flex flex-col md:flex-row gap-4 justify-start">
                  <a href="{{ route('auth.login') }}" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700">
                      Ajukan Bantuan Sekarang
                  </a>
                  <a href="#" class="border border-blue-600 text-blue-600 px-6 py-3 rounded-full font-semibold hover:bg-blue-100">
                      Pelajari Lebih Lanjut
                  </a>
              </div>
          </div>
          <!-- Gambar Kanan -->
          <div class="w-full md:w-1/2 px-6 flex justify-center items-center">
              <img src="{{ asset('images/logoRumah.png') }}" alt="Ilustrasi Rumah" class="w-full max-w-md" />
          </div>
      </div>
    </section>
  <!-- Apa itu SI-Hunlay -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold mb-4">Apa itu SI-Hunlay?</h2>
      <p class="text-gray-600 mb-10 max-w-3xl mx-auto">
        SI-Hunlay adalah sistem digital Kota Kendari untuk pendataan dan pengajuan bantuan rumah tidak layak huni. Kami membantu memastikan masyarakat Kota Kendari mendapatkan hunian yang layak.
      </p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <!-- Box 1 -->
        <div class="p-6 border rounded-lg shadow-md flex flex-col items-center">
          <div class="mb-4">
            <img src="{{ asset('images/icon-data.png') }}" alt="Pendataan Icon" class="w-12 h-12">
          </div>
          <h3 class="font-semibold text-lg mb-2">Pendataan Digital</h3>
          <p class="text-gray-600 text-sm text-center">Semua data dikelola secara digital untuk transparansi dan efisiensi.</p>
        </div>
        <!-- Box 2 -->
        <div class="p-6 border rounded-lg shadow-md flex flex-col items-center">
          <div class="mb-4">
            <img src="{{ asset('images/icon-bantuan.png') }}" alt="Bantuan Icon" class="w-12 h-12">
          </div>
          <h3 class="font-semibold text-lg mb-2">Bantuan Hunian</h3>
          <p class="text-gray-600 text-sm text-center">Ajukan bantuan secara mudah dan pantau statusnya secara online.</p>
        </div>
        <!-- Box 3 -->
        <div class="p-6 border rounded-lg shadow-md flex flex-col items-center">
          <div class="mb-4">
            <img src="{{ asset('images/icon-warga.png') }}" alt="Warga Icon" class="w-12 h-12">
          </div>
          <h3 class="font-semibold text-lg mb-2">Untuk Masyarakat</h3>
          <p class="text-gray-600 text-sm text-center">Siapapun warga Kota Kendari yang memenuhi syarat bisa mendaftar.</p>
        </div>
      </div>
    </div>
  </section>
  <!-- Cara Mengajukan -->
  <section class="bg-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold mb-10">Bagaimana Cara Mengajukan Bantuan?</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <!-- Box 1 -->
        <div class="relative bg-white p-4 rounded-lg shadow flex flex-col items-center">
          <div class="absolute top-3 left-3 w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white font-bold text-sm">1</div>
          <h4 class="font-semibold mt-6 mb-1 text-sm">Daftar Akun</h4>
          <p class="text-xs text-gray-600 text-center mb-3">Buat akun secara gratis dengan email atau nomor HP Anda.</p>
          <div class="pt-4">
            <img src="{{ asset('images/icon-daftar.png') }}" alt="Icon Daftar" class="w-10 h-10 mx-auto">
          </div>
        </div>
        <!-- Box 2 -->
        <div class="relative bg-white p-4 rounded-lg shadow flex flex-col items-center">
          <div class="absolute top-3 left-3 w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white font-bold text-sm">2</div>
          <h4 class="font-semibold mt-6 mb-1 text-sm">Isi Data Hunian</h4>
          <p class="text-xs text-gray-600 text-center mb-3">Isi informasi rumah dan kondisi hunian saat ini.</p>
          <div class="pt-4">
            <img src="{{ asset('images/icon-data.png') }}" alt="Icon Data" class="w-10 h-10 mx-auto">
          </div>
        </div>
        <!-- Box 3 -->
        <div class="relative bg-white p-4 rounded-lg shadow flex flex-col items-center">
          <div class="absolute top-3 left-3 w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white font-bold text-sm">3</div>
          <h4 class="font-semibold mt-6 mb-1 text-sm">Unggah Dokumen</h4>
          <p class="text-xs text-gray-600 text-center mb-3">Unggah dokumen pendukung seperti foto rumah dan surat kepemilikan.</p>
          <div class="pt-4">
            <img src="{{ asset('images/icon-upload.png') }}" alt="Icon Upload" class="w-10 h-10 mx-auto">
          </div>
        </div>
        <!-- Box 4 -->
        <div class="relative bg-white p-4 rounded-lg shadow flex flex-col items-center">
          <div class="absolute top-3 left-3 w-8 h-8 flex items-center justify-center rounded-full bg-blue-600 text-white font-bold text-sm">4</div>
          <h4 class="font-semibold mt-6 mb-1 text-sm">Proses Verifikasi</h4>
          <p class="text-xs text-gray-600 text-center mb-3">Tim kami akan memverifikasi dan memberi kabar secepatnya.</p>
          <div class="pt-4">
            <img src="{{ asset('images/icon-verifikasi.png') }}" alt="Icon Verifikasi" class="w-10 h-10 mx-auto">
          </div>
        </div>
      </div>
    </div>
  </section>
  <!-- Dukungan -->
  <section class="py-12 bg-blue-50">
    <div class="max-w-5xl mx-auto flex flex-col md:flex-row items-center gap-6 px-4">
      <!-- Logo Utama -->
      <div class="flex-shrink-0 rounded-full bg-blue-600 p-3 md:p-4 inline-flex items-center justify-center">
        <img src="{{ asset('images/Perumahan.png') }}" alt="Logo Disperkim" class="w-20 h-20 md:w-24 md:h-24 object-contain">
      </div>
      <!-- Teks Dukungan -->
      <div class="text-gray-700 text-center md:text-left">
        <p class="mb-2">
          <strong class="text-black text-2xl block">Program didukung oleh</strong>
          Program <strong>SI-Hunlay</strong> didukung penuh oleh <strong>Dinas Perumahan dan Permukiman Kota Kendari</strong> sebagai bagian dari program peningkatan kualitas hunian masyarakat.
        </p>
        <div class="flex items-center justify-center md:justify-start mt-2 gap-2">
          <img src="{{ asset('images/logoHomeBlack.png') }}" alt="Logo Disperkim Kecil" class="w-6 h-6 object-contain">
          <span class="font-semibold text-gray-800 leading-none self-center">Dinas Perumahan dan Permukiman Kota Kendari</span>
        </div>
      </div>
    </div>
  </section>
  <!-- CTA -->
  <section class="bg-blue-600 text-white py-12 text-center">
    <h2 class="text-2xl font-bold mb-4">Siap Mengajukan Bantuan?</h2>
    <p class="mb-6">Daftarkan diri Anda sekarang dan mulai proses pengajuan bantuan rumah tidak layak huni melalui SI-Hunlay.</p>
    <a href="{{ route('auth.register') }}" class="bg-white text-blue-600 font-semibold px-6 py-2 rounded hover:bg-gray-100">Daftar Sekarang</a>
  </section>
  <footer class="bg-gray-900 text-white py-10">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-8 text-sm">
      <!-- Logo + Deskripsi -->
      <div>
        <div class="flex items-center gap-3 mb-2">
          <img src="{{ asset('images/logoHomeWhite.png') }}" alt="Logo SI-Hunlay" class="w-8 h-8">
          <h4 class="font-semibold text-base">SI-Hunlay</h4>
        </div>
        <p>Sistem informasi hunian layak untuk masyarakat Kota Kendari. Mengelola bantuan RTLH secara transparan dan efisien.</p>
      </div>
      <!-- Kontak -->
      <div>
        <h4 class="font-semibold mb-2">Kontak</h4>
        <p class="flex items-center space-x-2">
          <img src="{{ asset('images/location.png') }}" alt="Icon Lokasi" class="w-4 h-4">
          <span>Jl. HEA. Mokodompit, Kendari</span>
        </p>
        <p class="flex items-center space-x-2">
          <img src="{{ asset('images/email.png') }}" alt="Icon Email" class="w-4 h-4">
          <span>Email: info@hunlay.kendari.go.id</span>
        </p>
        <p class="flex items-center space-x-2">
          <img src="{{ asset('images/phone.png') }}" alt="Icon Telepon" class="w-4 h-4">
          <span>Telp: 0401-123456</span>
        </p>
      </div>
      <!-- Tautan -->
      <div>
        <h4 class="font-semibold mb-2">Tautan</h4>
        <p><a href="#" class="hover:underline">Beranda</a></p>
        <p><a href="#" class="hover:underline">Tentang</a></p>
        <p><a href="#" class="hover:underline">FAQ</a></p>
      </div>
    </div>
    <div class="text-center text-xs text-gray-400 mt-8">
      &copy; 2025 SI-Hunlay Kota Kendari. Hak Cipta Dilindungi.
    </div>
  </footer>
</body>
</html>
