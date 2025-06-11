@extends('warga.layout.master')
@section('title', 'Warga - Dashboard')
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
      <a href="{{ route('warga.pengajuan') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Ajukan Sekarang</a>
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
  
  {{-- Progress Pengajuan --}}
  <div class="bg-white p-6 rounded-xl shadow">
      <h4 class="text-lg font-semibold mb-4">Progress Pengajuan</h4>
      
      <div class="relative">
          <!-- Background line untuk semua step -->
          <div class="absolute top-4 left-4 right-4 h-0.5 bg-gray-300"></div>
          
          <!-- Active progress line -->
          <div class="absolute top-4 left-4 h-0.5 bg-blue-600 transition-all duration-500"
              style="width: calc({{ min((($status ?? 1) - 1), 4) * 20 }}% + {{ min((($status ?? 1) - 1), 4) * 0.5 }}rem);"></div>
          
          <!-- Steps container -->
          <div class="flex justify-between items-start relative">
              @for ($i = 1; $i <= 6; $i++)
                  <div class="flex flex-col items-center text-center flex-1">
                      <!-- Circle with number or checkmark -->
                      <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold mb-2 relative z-10 transition-all duration-300
                          {{ $i <= ($status ?? 1) ? 'bg-blue-600 text-white shadow-lg' : ($i == ($status ?? 1) && $i < 6 ? 'bg-blue-600 text-white shadow-lg' : 'bg-gray-300 text-gray-700') }}">
                          
                          @if ($i < ($status ?? 1) && $i < 6)
                              <!-- Checkmark icon untuk step yang sudah selesai -->
                              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                              </svg>
                          @elseif ($i == ($status ?? 1) && $i < 6)
                              <!-- Nomor untuk step saat ini -->
                              {{ $i }}
                          @else
                              <!-- Nomor untuk step yang belum atau Selesai -->
                              {{ $i }}
                          @endif
                      </div>
                      
                      <!-- Step label -->
                      <div class="text-xs font-medium max-w-20 leading-tight
                          {{ $i <= ($status ?? 1) ? 'text-blue-600' : 'text-gray-600' }}">
                          @if ($i == 1) 
                              Pengajuan<br>Diterima
                          @elseif ($i == 2) 
                              Verifikasi<br>Dokumen
                          @elseif ($i == 3) 
                              Jadwal<br>Survei
                          @elseif ($i == 4) 
                              Hasil<br>Survei
                          @elseif ($i == 5) 
                              Keputusan<br>Bantuan
                          @else 
                              Pelaksanaan<br>Bantuan
                          @endif
                      </div>
                  </div>
              @endfor
          </div>
      </div>
  </div>

</div>

@endsection