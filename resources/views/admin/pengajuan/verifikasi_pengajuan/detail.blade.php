@extends('admin.layouts.layout')

@section('title', 'Verifikasi Pengajuan')

@section('content')
{{-- Menghapus pb-20 karena tombol tidak lagi fixed di footer --}}
<div class="">
    {{-- Header Halaman - HANYA JUDUL, TANPA TOMBOL KEMBALI --}}
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Verifikasi Pengajuan</h1>
    </div>

    {{-- Data Pribadi Pemohon --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <span class="mr-2">📄</span>Data Pribadi Pemohon
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700">
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Nama</p>
                <p class="font-medium">{{ $pengajuan->warga->user->nama ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Email</p>
                <p class="font-medium">{{ $pengajuan->warga->user->email ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">No. HP</p>
                <p class="font-medium">{{ $pengajuan->warga->no_hp ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">NIK</p>
                <p class="font-medium">{{ $pengajuan->warga->nik ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Pekerjaan Utama</p>
                <p class="font-medium">{{ $pengajuan->pekerjaan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">NO. KK</p>
                <p class="font-medium">{{ $pengajuan->warga->no_kk ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Penghasilan Perbulan</p>
                <p class="font-medium">Rp {{ number_format($pengajuan->penghasilan ?? 0, 0, ',', '.') }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Kecamatan/Kelurahan</p>
                <p class="font-medium">
                    {{ $pengajuan->warga->kelurahan->kecamatan->nama ?? '-' }} /
                    {{ $pengajuan->warga->kelurahan->nama ?? '-' }}
                </p>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-500 text-sm mb-0.5">Alamat Lengkap</p>
                <p class="font-medium">{{ $pengajuan->alamat_lengkap ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Kondisi Fisik Rumah --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <span class="mr-2">🏚️</span>Kondisi Fisik Rumah
        </h3>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700">
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Atap</p>
                <p class="font-medium">
                    @foreach ($pengajuan->kondisi_atap ?? [] as $item)
                        {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @empty($pengajuan->kondisi_atap) - @endempty
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Dinding</p>
                <p class="font-medium">
                    @foreach ($pengajuan->kondisi_dinding ?? [] as $item)
                        {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @empty($pengajuan->kondisi_dinding) - @endempty
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Lantai</p>
                <p class="font-medium">
                    @foreach ($pengajuan->kondisi_lantai ?? [] as $item)
                        {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @empty($pengajuan->kondisi_lantai) - @endempty
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Ventilasi dan Pencahayaan</p>
                <p class="font-medium">
                    @foreach ($pengajuan->ventilasi_pencahayaan ?? [] as $item)
                        {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @empty($pengajuan->ventilasi_pencahayaan) - @endempty
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Kondisi Sanitasi & Air Bersih</p>
                <p class="font-medium">
                    @foreach ($pengajuan->sanitasi_airbersih ?? [] as $item)
                        {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                    @endforeach
                    @empty($pengajuan->sanitasi_airbersih) - @endempty
                </p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Luas Rumah</p>
                <p class="font-medium">{{ $pengajuan->luas_rumah ?? '-' }} m²</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Jumlah Penghuni</p>
                <p class="font-medium">{{ $pengajuan->jumlah_penghuni ?? '-' }}</p>
            </div>
        </div>
    </div>

    {{-- Dokumen Pendukung --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h3 class="text-lg font-semibold text-gray-800 mb-4">
            <span class="mr-2">📁</span>Dokumen Pendukung
        </h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @php
                $jenisDokumenOrder = [
                    'kartu_tanda_penduduk',
                    'kartu_keluarga',
                    'surat_keterangan_tidak_mampu',
                    'bukti_kepemilikan_rumah',
                    'foto_rumah_tampak_depan',
                    'foto_rumah_tampak_belakang',
                    'foto_bagian_rumah_yang_rusak'
                ];

                $dokumenMap = [];
                foreach ($pengajuan->dokumen as $dok) {
                    $dokumenMap[$dok->jenis_dokumen] = $dok;
                }
            @endphp

            @forelse ($jenisDokumenOrder as $jenis)
                @php
                    $dok = $dokumenMap[$jenis] ?? null;
                    $title = ucwords(str_replace('_', ' ', $jenis));
                @endphp
                <div class="relative flex flex-col items-center justify-between border border-gray-200 rounded-lg p-4 bg-gray-50 hover:shadow-md transition-shadow duration-200">
                    @if ($dok && $dok->path_file)
                        <img src="{{ asset('storage/' . $dok->path_file) }}" alt="{{ $title }}" class="w-full h-32 object-cover rounded-md mb-3 flex-shrink-0">
                    @else
                        <div class="w-full h-32 bg-gray-200 rounded-md flex items-center justify-center text-gray-400 mb-3 flex-shrink-0">
                            <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-4 3 3 5-5V15z" clip-rule="evenodd"></path>
                            </svg>
                        </div>
                    @endif
                    <p class="text-sm font-medium text-gray-700 text-center mb-2 flex-grow">{{ $title }}</p>
                    @if ($dok && $dok->path_file)
                        <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank" class="text-blue-600 text-xs font-semibold hover:underline">Lihat Detail</a>
                    @else
                        <span class="text-gray-400 text-xs">Belum Ada</span>
                    @endif
                </div>
            @empty
                <p class="text-sm col-span-full text-gray-500 italic text-center">Belum ada dokumen terunggah.</p>
            @endforelse
        </div>
    </div>

    {{-- Tombol Aksi (Tidak Fixed) --}}
    <div class="mt-8 flex justify-between items-center">
        <a href="{{ route('admin.pengajuan.index') }}"
           class="inline-flex items-center px-4 py-2 bg-gray-100 text-gray-700 rounded-lg hover:bg-gray-200 font-medium transition duration-150 ease-in-out">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
            Kembali
        </a>

        <div class="flex space-x-3">
            <form action="{{ route('admin.pengajuan.tolak', $pengajuan->id) }}" method="POST" class="inline-block">
                @csrf
                @method('PUT')
                <button type="submit"
                        class="inline-flex items-center px-5 py-2 border border-red-600 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 font-medium transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                    Tolak
                </button>
            </form>

            <form action="{{ route('admin.pengajuan.setujui', $pengajuan->id) }}" method="POST" class="inline-block">
                @csrf
                @method('PUT')
                <button type="submit"
                        class="inline-flex items-center px-5 py-2 border border-blue-600 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-medium transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                    Setujui
                </button>
            </form>
        </div>
    </div>
</div>
@endsection