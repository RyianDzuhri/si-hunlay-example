@extends('warga.layout.master')
@section('title', 'Warga - Dashboard')
@section('content')
<div class="space-y-8">
    {{-- Greeting --}}
    <div>
        <h2 class="text-2xl font-bold text-black">Halo, {{ $user->nama_lengkap }}</h2>
        <p class="text-gray-600">Selamat datang di dashboard Si-Hunlay</p>
    </div>

    {{-- Menu Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4">
        
        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">+</div>
                <h3 class="text-lg font-semibold">Ajukan Bantuan</h3>
            </div>
            @if ($pengajuan)
                <p class="text-sm text-gray-600 mb-4">Anda sudah memiliki pengajuan aktif.</p>
                <span class="inline-block bg-gray-300 text-gray-500 px-4 py-2 rounded-lg text-sm cursor-not-allowed">Anda Sudah Mengajukan</span>
            @else
                <p class="text-sm text-gray-600 mb-4">Buat Pengajuan bantuan rumah tidak layak huni baru.</p>
                <a href="{{ route('warga.ajukan') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg text-sm">Ajukan Sekarang</a>
            @endif
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">⏱</div>
                <h3 class="text-lg font-semibold">Pengajuan Saya</h3>
            </div>
            <p class="text-sm text-gray-600 mb-4">Lihat status dan riwayat pengajuan bantuan anda.</p>
            @if ($pengajuan)
                <a href="#" class="inline-block border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-50">Lihat Riwayat</a>
            @else
                <a href="#" onclick="alert('Anda harus mengajukan bantuan terlebih dahulu untuk dapat melihat riwayat.'); return false;" class="inline-block border border-gray-300 text-gray-400 px-4 py-2 rounded-lg text-sm cursor-not-allowed">Lihat Riwayat</a>
            @endif
        </div>

        <div class="bg-white p-6 rounded-xl shadow">
            <div class="flex items-center gap-3 mb-4">
                <div class="w-10 h-10 bg-blue-100 rounded-full flex items-center justify-center text-blue-600 text-xl font-bold">📄</div>
                <h3 class="text-lg font-semibold">Panduan Pengajuan</h3>
            </div>
            <p class="text-sm text-gray-600 mb-4">Pelajari cara mengajukan bantuan dengan benar.</p>
            <a href="#" class="inline-block border border-blue-600 text-blue-600 px-4 py-2 rounded-lg text-sm hover:bg-blue-50">Baca Panduan</a>
        </div>
    </div>
 
    {{-- Progress Pengajuan --}}
    <div class="bg-white p-8 rounded-xl shadow"> {{-- Padding diubah menjadi p-8 untuk lebih banyak ruang --}}
        
        {{-- Judul dengan margin bawah yang lebih besar --}}
        <h4 class="text-lg font-semibold mb-12 text-center sm:text-left">Progress Pengajuan Anda</h4>

        @if ($pengajuan)
            {{-- Logika jika SUDAH ADA pengajuan --}}
            @if ($pengajuan->status != 'DITOLAK')
                <div class="relative">
                    @php 
                        $totalSteps = count($statusMapping);
                        // Logika persentase untuk garis biru
                        $widthPercentage = $currentStep > 1 ? (($currentStep - 1) / ($totalSteps - 1)) * 100 : 0;
                    @endphp
                    {{-- Garis abu-abu di background --}}
                    <div class="absolute top-4 left-0 right-0 h-1 bg-gray-200 w-full"></div>
                    {{-- Garis biru yang menunjukkan progress --}}
                    <div class="absolute top-4 left-0 h-1 bg-blue-600 transition-all duration-500" style="width: {{ $widthPercentage }}%;"></div>
                    
                    <div class="flex justify-between items-start relative">
                        @foreach ($statusMapping as $details)
                            <div class="flex flex-col items-center text-center w-24">
                                {{-- Lingkaran ikon --}}
                                <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold mb-2 relative z-10 transition-all duration-300
                                    {{ $currentStep >= $details['step'] ? 'bg-blue-600 text-white' : 'bg-gray-200 text-gray-500' }}">
                                    @if ($currentStep > $details['step'])
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                                    @else
                                        {{ $details['step'] }}
                                    @endif
                                </div>
                                {{-- Label Teks --}}
                                <div class="text-xs font-semibold leading-tight mt-1 {{ $currentStep >= $details['step'] ? 'text-blue-600' : 'text-gray-500' }}">
                                    {!! str_replace(' ', '<br>', $details['label']) !!}
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @else
                {{-- Tampilan khusus jika status DITOLAK --}}
                @php $lastHistory = $pengajuan->histori()->latest('waktu_perubahan')->first(); @endphp
                <div class="p-4 bg-red-50 border border-red-300 text-red-800 rounded-lg text-center">
                    <h3 class="font-bold text-lg">PENGAJUAN ANDA DITOLAK</h3>
                    @if ($lastHistory && $lastHistory->catatan)
                        <p class="mt-2 text-sm"><strong>Alasan:</strong> {{ $lastHistory->catatan }}</p>
                    @endif
                </div>
            @endif
        @else
            {{-- Tampilan jika BELUM ADA pengajuan --}}
            <div class="relative">
                <div class="absolute top-4 left-0 right-0 h-1 bg-gray-200 w-full"></div>
                <div class="flex justify-between items-start relative">
                    @foreach (['Pengajuan Dibuat', 'Verifikasi Dokumen', 'Proses Survei', 'Evaluasi Final', 'Bantuan Disetujui'] as $index => $label)
                        <div class="flex flex-col items-center text-center w-24">
                            <div class="w-8 h-8 rounded-full flex items-center justify-center font-bold mb-2 relative z-10 bg-gray-200 text-gray-500">
                                {{ $index + 1 }}
                            </div>
                            <div class="text-xs font-semibold leading-tight text-gray-500 mt-1">
                                {!! str_replace(' ', '<br>', $label) !!}
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <p class="text-center text-sm text-gray-500 mt-10">
                Anda belum memiliki pengajuan. Silakan ajukan bantuan untuk memulai progres ini.
            </p>
        @endif
    </div>
</div>
@endsection