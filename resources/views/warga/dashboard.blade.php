@extends('warga.layout')
@section('title', 'Dashboard')
@section('content')
<div class="space-y-8">
  <!-- Greeting -->
  <div>
    <h2 class="text-2xl font-bold text-black">Halo, Krisnaaaaaa</h2>
    <p class="text-gray-600">Selamat datang di dashboard Si-Hunlay</p>
  </div>

  <!-- Menu Cards -->
  <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
    <div class="bg-white p-6 rounded-xl shadow">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">+</div>
        <h3 class="text-lg font-semibold">Ajukan Bantuan</h3>
      </div>
      <p class="text-sm text-gray-600 mb-4">Buat Pengajuan bantuan rumah tidak layak huni baru</p>
      <a href="#" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Ajukan Sekarang</a>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">⏱</div>
        <h3 class="text-lg font-semibold">Pengajuan Saya</h3>
      </div>
      <p class="text-sm text-gray-600 mb-4">Lihat status dan riwayat pengajuan bantuan anda</p>
      <a href="#" class="inline-block border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-50">Lihat Riwayat</a>
    </div>
    <div class="bg-white p-6 rounded-xl shadow">
      <div class="flex items-center gap-3 mb-4">
        <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">📄</div>
        <h3 class="text-lg font-semibold">Panduan Pengajuan</h3>
      </div>
      <p class="text-sm text-gray-600 mb-4">Pelajari cara mengajukan bantuan dengan benar</p>
      <a href="#" class="inline-block border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-50">Baca Panduan</a>
    </div>
  </div>

    <!-- Progress Pengajuan -->
    <div class="bg-white p-6 rounded-xl shadow">
        <h4 class="text-lg font-semibold mb-4">Progress Pengajuan</h4>
        <div class="flex items-center justify-between text-center text-sm relative">
            @for ($i = 1; $i <= 5; $i++)
            <div class="flex-1 relative z-10">
                <div class="w-8 h-8 rounded-full bg-gray-300 text-gray-700 flex items-center justify-center font-bold mx-auto">
                {{ $i }}
                </div>
                <div class="mt-2 text-xs font-medium text-gray-700">
                @if ($i == 1) Pengajuan Diterima
                @elseif ($i == 2) Verifikasi Dokumen
                @elseif ($i == 3) Jadwal Survei
                @elseif ($i == 4) Survei Lapangan
                @else Keputusan Bantuan
                @endif
                </div>
            </div>
            @if ($i < 5)
                <!-- Garis penghubung antar step -->
                <div class="flex-1 h-1 bg-gray-300 -mx-4 z-0"></div>
            @endif
            @endfor
        </div>
    </div>
</div>

@endsection