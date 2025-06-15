@extends('warga.layout.master')

@section('title', 'Warga - Riwayat Pengajuan')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-1">Riwayat Pengajuan Bantuan RTLH</h1>
    <p class="text-gray-600 mb-6">Berikut adalah detail pengajuan Anda.</p>

    @if($pengajuan)
        <!-- Data Pribadi Pemohon -->
                <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center">
                <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                </svg>
                Data Pribadi Pemohon
            </h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-1 text-base leading-relaxed">
                {{-- Kolom Kiri --}}
                <div>
                    <p><span class="text-gray-600">Nama</span><br>{{ $user->nama ?? 'N/A' }}</p>
                    <p class="mt-2"><span class="text-gray-600">No. HP</span><br>{{ $warga->no_hp ?? 'N/A' }}</p>
                    
                    {{-- INI TAMBAHANNYA --}}
                    <p class="mt-2"><span class="text-gray-600">Pekerjaan</span><br>{{ Str::ucfirst(str_replace('_', ' ', $pengajuan->pekerjaan ?? '')) }}</p>
                    <p class="mt-2"><span class="text-gray-600">Nomor Kartu Keluarga</span><br>{{ $warga->no_kk }}</p>
                </div>
                
                {{-- Kolom Kanan --}}
                <div>
                    <p><span class="text-gray-600">Nomor Induk Keluarga</span><br>{{ $warga->nik ?? 'N/A' }}</p>
                    <p class="mt-2"><span class="text-gray-600">Email</span><br>{{ $user->email ?? 'N/A' }}</p>
                    
                    {{-- INI TAMBAHANNYA --}}
                    <p class="mt-2"><span class="text-gray-600">Penghasilan Per Bulan</span><br>Rp {{ number_format($pengajuan->penghasilan ?? 0, 0, ',', '.') }}</p>
                    <p><span class="text-gray-600">Alamat Rumah yang Diajukan</span><br>{{ $pengajuan->alamat_lengkap ?? 'N/A' }}</p>
                </div>
                

            </div>
        </div>

        <!-- Data Pengajuan -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 text-gray-800 flex items-center">
                {{-- Ikon dokumen --}}
                <svg class="w-6 h-6 mr-2 text-gray-600" fill="currentColor" viewBox="0 0 24 24">
                    <path fill-rule="evenodd" d="M4 4a2 2 0 012-2h4.586A2 2 0 0113 3.414L16.586 7A2 2 0 0117 8.414V20a2 2 0 01-2 2H6a2 2 0 01-2-2V4zm4.5 9A1.5 1.5 0 007 14.5v3A1.5 1.5 0 008.5 19h7A1.5 1.5 0 0017 17.5v-3A1.5 1.5 0 0015.5 13h-7zm0-5A1.5 1.5 0 007 9.5v3A1.5 1.5 0 008.5 14h7A1.5 1.5 0 0017 12.5v-3A1.5 1.5 0 0015.5 8h-7z" clip-rule="evenodd"></path>
                </svg>
                Data Pengajuan
            </h2>

            {{-- Grid 2x2 --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-x-12 gap-y-6 text-base leading-normal">
                <div>
                    <p class="text-gray-600">Tanggal Pengajuan</p>
                    <p class="text-gray-900">{{ $pengajuan->tgl_pengajuan->format('d F Y') }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Luas Rumah</p>
                    <p class="text-gray-900">{{ $pengajuan->luas_rumah }} m²</p>
                </div>
                <div>
                    <p class="text-gray-600">Jumlah Penghuni</p>
                    <p class="text-gray-900">{{ $pengajuan->jumlah_penghuni }}</p>
                </div>
                <div>
                    <p class="text-gray-600">Jenis Kerusakan</p>
                    <ul class="list-disc list-inside text-gray-900 mt-1 font-medium">
                        {{-- Kita terapkan format yang sama di dalam loop --}}
                        @foreach($pengajuan->jenis_kerusakan as $kerusakan)
                            <li>{{ Str::ucfirst(str_replace('_', ' ', $kerusakan)) }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>

        <!-- Dokumen Pendukung -->
        <div class="bg-white shadow rounded-lg p-6 mb-6">
            <h2 class="text-lg font-semibold mb-4 border-l-4 border-blue-500 pl-2">Dokumen Pendukung</h2>
            {{-- Perubahan: Mengubah layout menjadi 1 kolom pada layar kecil dan 2 kolom pada layar sedang/besar --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                @foreach($pengajuan->dokumen as $doc)
                    <div class="relative group border border-gray-200 rounded-lg overflow-hidden shadow-sm hover:shadow-md transition-shadow duration-200">
                        <img src="{{ $doc->url }}" alt="{{ $doc->nama }}" class="w-full h-32 object-cover">
                        <div class="p-2 text-center text-sm font-medium text-gray-700">
                            {{ $doc->nama }}
                        </div>
                        <a href="{{ $doc->url }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                            Lihat Detail
                        </a>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
            <p class="font-bold">Info</p>
            <p>Anda belum memiliki riwayat pengajuan.</p>
        </div>
    @endif
</div>
@endsection