<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Si-Hunlay Kota Kendari</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white text-gray-800">

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
      <a href="#" class="text-blue-600 no-underline hover:text-blue-700">Masuk</a>
    </nav>

    <!-- Tombol Daftar -->
    <a href="#" class="hidden md:inline-block bg-blue-600 text-white px-4 py-2 ml-6 rounded-md text-sm font-semibold hover:bg-blue-700">
      Daftar Sekarang
    </a>

  </div>
</header>

  <section class="bg-blue-50 py-20">
    <div class="max-w-7xl mx-auto px-6 flex flex-col-reverse md:flex-row items-center justify-between gap-x-16">
        
        <!-- Konten Kiri -->
        <div class="w-full md:w-1/2 px-6 flex flex-col justify-center">
            <h1 class="text-3xl md:text-4xl font-extrabold text-gray-900 leading-tight mb-4">
                Selamat Datang di Si-Hunlay Kota Kendari
            </h1>
            <p class="text-gray-700 mb-6">
                Sistem Informasi Hunian Layak untuk mendukung masyarakat<br />
                Mendapatkan bantuan RTLH
            </p>
            <div class="flex flex-col md:flex-row gap-4 justify-start">
                <a href="#" class="bg-blue-600 text-white px-6 py-3 rounded-full font-semibold hover:bg-blue-700">
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



  <!-- Apa itu Si-Hunlay -->
  <section class="py-16 bg-white">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold mb-4">Apa itu Si-Hunlay?</h2>
      <p class="text-gray-600 mb-10 max-w-3xl mx-auto">Si-Hunlay adalah sistem digital Kota Kendari untuk pendataan dan pengajuan bantuan rumah tidak layak huni. Kami membantu memastikan masyarakat Kota Kendari mendapatkan hunian yang layak.</p>
      <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
        <div class="p-6 border rounded-lg shadow-sm">
          <h3 class="font-semibold text-lg mb-2">Pendataan Digital</h3>
          <p class="text-gray-600 text-sm">Semua data dikelola secara digital untuk transparansi dan efisiensi.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
          <h3 class="font-semibold text-lg mb-2">Bantuan Hunian</h3>
          <p class="text-gray-600 text-sm">Ajukan bantuan secara mudah dan pantau statusnya secara online.</p>
        </div>
        <div class="p-6 border rounded-lg shadow-sm">
          <h3 class="font-semibold text-lg mb-2">Untuk Masyarakat</h3>
          <p class="text-gray-600 text-sm">Siapapun warga Kota Kendari yang memenuhi syarat bisa mendaftar.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Cara Mengajukan -->
  <section class="bg-blue-50 py-16">
    <div class="max-w-6xl mx-auto px-4 text-center">
      <h2 class="text-2xl font-bold mb-10">Bagaimana Cara Mengajukan Bantuan?</h2>
      <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white p-6 rounded-lg shadow text-center">
          <div class="text-blue-600 text-2xl font-bold mb-2">1</div>
          <h4 class="font-semibold mb-1">Daftar Akun</h4>
          <p class="text-sm text-gray-600">Buat akun secara gratis dengan email atau nomor HP Anda.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
          <div class="text-blue-600 text-2xl font-bold mb-2">2</div>
          <h4 class="font-semibold mb-1">Isi Data Hunian</h4>
          <p class="text-sm text-gray-600">Isi informasi rumah dan kondisi hunian saat ini.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
          <div class="text-blue-600 text-2xl font-bold mb-2">3</div>
          <h4 class="font-semibold mb-1">Unggah Dokumen</h4>
          <p class="text-sm text-gray-600">Unggah dokumen pendukung seperti foto rumah dan surat kepemilikan.</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow text-center">
          <div class="text-blue-600 text-2xl font-bold mb-2">4</div>
          <h4 class="font-semibold mb-1">Proses Verifikasi</h4>
          <p class="text-sm text-gray-600">Tim kami akan memverifikasi dan memberi kabar secepatnya.</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Dukungan -->
  <section class="py-12 bg-white text-center">
    <p class="text-gray-600 max-w-xl mx-auto mb-4">Program Si-Hunlay didukung penuh oleh Dinas Perumahan dan Permukiman Kota Kendari sebagai bagian dari program peningkatan kualitas hunian masyarakat.</p>
    <p class="font-semibold">Dinas Perumahan dan Permukiman Kota Kendari</p>
  </section>

  <!-- CTA -->
  <section class="bg-blue-600 text-white py-12 text-center">
    <h2 class="text-2xl font-bold mb-4">Siap Mengajukan Bantuan?</h2>
    <p class="mb-6">Daftarkan diri Anda sekarang dan mulai proses pengajuan bantuan rumah tidak layak huni melalui Si-Hunlay.</p>
    <a href="#" class="bg-white text-blue-600 font-semibold px-6 py-2 rounded hover:bg-gray-100">Daftar Sekarang</a>
  </section>

  <!-- Footer -->
  <footer class="bg-gray-900 text-white py-10">
    <div class="max-w-6xl mx-auto px-4 grid md:grid-cols-3 gap-8 text-sm">
      <div>
        <h4 class="font-semibold mb-2">Si-Hunlay</h4>
        <p>Sistem informasi hunian layak untuk masyarakat Kota Kendari. Mengelola bantuan RTLH secara transparan dan efisien.</p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">Kontak</h4>
        <p>Jl. Sam Ratulangi, Kendari</p>
        <p>Email: info@hunlay.kendari.go.id</p>
        <p>Telp: 0401-123456</p>
      </div>
      <div>
        <h4 class="font-semibold mb-2">Tautan</h4>
        <p><a href="#" class="hover:underline">Beranda</a></p>
        <p><a href="#" class="hover:underline">Tentang</a></p>
        <p><a href="#" class="hover:underline">FAQ</a></p>
      </div>
    </div>
    <div class="text-center text-xs text-gray-400 mt-8">&copy; 2025 Si-Hunlay Kota Kendari. Hak Cipta Dilindungi.</div>
  </footer>

</body>
</html>
