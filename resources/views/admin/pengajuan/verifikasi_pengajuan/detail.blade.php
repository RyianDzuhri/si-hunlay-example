@extends('admin.layouts.layout')

@section('title', 'Verifikasi Pengajuan')

@section('content')
<div class="p-6 bg-white shadow rounded">
    <h2 class="text-xl font-bold mb-4">Verifikasi Pengajuan</h2>

    {{-- Data Pribadi Pemohon --}}
    <div class="mb-6 p-4 border rounded bg-gray-50">
        <h3 class="font-semibold mb-2">📄 Data Pribadi Pemohon</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><strong>Nama:</strong> {{ $pengajuan->warga->user->nama ?? '-' }}</div>
            <div><strong>Email:</strong> {{ $pengajuan->warga->user->email ?? '-' }}</div>
            <div><strong>No. HP:</strong> {{ $pengajuan->warga->no_hp ?? '-' }}</div>
            <div><strong>NIK:</strong> {{ $pengajuan->warga->nik ?? '-' }}</div>
            <div><strong>Pekerjaan:</strong> {{ $pengajuan->pekerjaan ?? '-' }}</div>
            <div><strong>No. KK:</strong> {{ $pengajuan->warga->no_kk ?? '-' }}</div>
            <div><strong>Penghasilan Perbulan:</strong> Rp {{ number_format($pengajuan->penghasilan ?? 0, 0, ',', '.') }}</div>
            <div><strong>Kecamatan/Kelurahan:</strong> 
                {{ $pengajuan->warga->kelurahan->kecamatan->nama ?? '-' }} / 
                {{ $pengajuan->warga->kelurahan->nama ?? '-' }}
            </div>
            <div class="col-span-2"><strong>Alamat Lengkap:</strong> {{ $pengajuan->alamat_lengkap }}</div>
        </div>
    </div>

    {{-- Kondisi Fisik Rumah --}}
    <div class="mb-6 p-4 border rounded bg-gray-50">
        <h3 class="font-semibold mb-2">🏚️ Kondisi Fisik Rumah</h3>
        <div class="grid grid-cols-2 gap-4 text-sm">
            <div><strong>Atap:</strong> 
                @foreach ($pengajuan->kondisi_atap ?? [] as $item)
                    {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
            <div><strong>Dinding:</strong> 
                @foreach ($pengajuan->kondisi_dinding ?? [] as $item)
                    {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
            <div><strong>Lantai:</strong> 
                @foreach ($pengajuan->kondisi_lantai ?? [] as $item)
                    {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
            <div><strong>Ventilasi & Pencahayaan:</strong> 
                @foreach ($pengajuan->ventilasi_pencahayaan ?? [] as $item)
                    {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
            <div><strong>Kondisi Sanitasi & Air Bersih:</strong> 
                @foreach ($pengajuan->sanitasi_airbersih ?? [] as $item)
                    {{ ucwords(str_replace('_', ' ', $item)) }}{{ !$loop->last ? ', ' : '' }}
                @endforeach
            </div>
            <div><strong>Luas Rumah:</strong> {{ $pengajuan->luas_rumah }} m²</div>
            <div><strong>Jumlah Penghuni:</strong> {{ $pengajuan->jumlah_penghuni }}</div>
        </div>
    </div>

    {{-- Dokumen Pendukung --}}
    <div class="mb-6 p-4 border rounded bg-gray-50">
        <h3 class="font-semibold mb-2">📁 Dokumen Pendukung</h3>
        <div class="grid grid-cols-3 gap-4">
            @forelse ($pengajuan->dokumen as $dok)
                <div class="text-center border rounded p-2 bg-white shadow-sm">
                    <img src="{{ asset('storage/' . $dok->path_file) }}" class="mx-auto h-24 object-cover" alt="{{ $dok->jenis_dokumen }}">
                    <p class="mt-2 text-sm">{{ ucwords(str_replace('_', ' ', $dok->jenis_dokumen)) }}</p>
                    <a href="{{ asset('storage/' . $dok->path_file) }}" target="_blank" class="text-blue-500 text-xs hover:underline">Lihat Detail</a>
                </div>
            @empty
                <p class="text-sm col-span-3 text-gray-500 italic">Belum ada dokumen terunggah.</p>
            @endforelse
        </div>
    </div>
    

    {{-- Tombol Aksi --}}
    <div class="flex justify-between">
        <a href="{{ route('admin.pengajuan.index') }}" class="px-4 py-2 bg-gray-200 rounded hover:bg-gray-300">← Kembali</a>
        
        {{-- <div class="space-x-2">
            <form action="{{ route('admin.pengajuan.tolak', $pengajuan->id) }}" method="POST" class="inline">
                @csrf
                <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">Tolak</button>
            </form>
            <form action="{{ route('admin.pengajuan.setujui', $pengajuan->id) }}" method="POST" class="inline">
                @csrf
                <button class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Setujui</button>
            </form>
        </div> --}}
    </div>
</div>
@endsection
