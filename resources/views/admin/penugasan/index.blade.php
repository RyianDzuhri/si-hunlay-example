@extends('admin.layouts.layout')

@section('title', 'Distribusi Tugas Verifikasi Lapangan')

@section('content')
<div class="p-0.5"> {{-- Mengurangi padding keseluruhan agar lebih mirip gambar --}}
    <h1 class="text-2xl font-bold mb-2 text-gray-900">Distribusi Tugas Verifikasi Lapangan</h1>
    <p class="text-gray-600 mb-6">Kelola dan distribusikan tugas verifikasi lapangan kepada petugas</p>

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.penugasan.index') }}" class="bg-white p-6 rounded-lg shadow-md mb-6 grid grid-cols-1 md:grid-cols-3 gap-6 items-end">
        {{-- Kecamatan/Kelurahan Filter --}}
        <div>
            <label for="kecamatan_id" class="block text-gray-700 text-sm font-medium mb-1">Kecamatan/Kelurahan</label>
            <div class="relative">
                <select name="kecamatan_id" id="kecamatan_id" onchange="this.form.submit()" class="appearance-none w-full p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <option value="">Semua Wilayah</option>
                    @foreach ($kecamatans as $kecamatan)
                        <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                            {{ $kecamatan->nama_kecamatan }}
                        </option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- Tanggal Pengajuan Filter --}}
        <div>
            <label for="tanggal_awal" class="block text-gray-700 text-sm font-medium mb-1">Tanggal Pengajuan</label>
            <div class="flex items-center gap-2">
                <div class="relative flex-1">
                    <input type="date" id="tanggal_awal" name="tanggal_awal" value="{{ request('tanggal_awal') }}"
                           onchange="this.form.submit()"
                           class="w-full p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M12 11h.01M15 11h.01M17 16h.01M7 16h.01M12 16h.01M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
                <span class="text-gray-500">s/d</span>
                <div class="relative flex-1">
                    <input type="date" id="tanggal_akhir" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}"
                           onchange="this.form.submit()"
                           class="w-full p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h.01M12 11h.01M15 11h.01M17 16h.01M7 16h.01M12 16h.01M4 20h16a2 2 0 002-2V6a2 2 0 00-2-2H4a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>

        {{-- Status Verifikasi Filter --}}
        <div>
            <label for="status" class="block text-gray-700 text-sm font-medium mb-1">Status Verifikasi</label>
            <div class="relative">
                <select name="status" id="status" onchange="this.form.submit()" class="appearance-none w-full p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <option value="">Semua Status</option>
                    {{-- Hanya tampilkan opsi status yang relevan untuk halaman ini --}}
                    <option value="DOKUMEN_LENGKAP" {{ request('status') == 'DOKUMEN_LENGKAP' ? 'selected' : '' }}>Dokumen Lengkap</option>
                    <option value="PROSES_SURVEY" {{ request('status') == 'PROSES_SURVEY' ? 'selected' : '' }}>Proses Survey</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b border-gray-200 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold text-xs">NO</th>
                    <th class="px-4 py-3 font-semibold text-xs">ID PENGAJUAN</th>
                    <th class="px-4 py-3 font-semibold text-xs">NAMA PENGAJU</th>
                    <th class="px-4 py-3 font-semibold text-xs">ALAMAT LENGKAP</th>
                    <th class="px-4 py-3 font-semibold text-xs">TANGGAL PENGAJUAN</th>
                    <th class="px-4 py-3 font-semibold text-xs">STATUS VERIFIKASI</th>
                    <th class="px-4 py-3 font-semibold text-xs">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($pengajuans as $index => $pengajuan)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">{{ $index + $pengajuans->firstItem() }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $pengajuan->kode_pengajuan }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $pengajuan->warga->user->nama ?? '-' }}</td>
                        <td class="px-4 py-3">{{ $pengajuan->alamat_lengkap }}</td> {{-- Biarkan wrapping --}}
                        <td class="px-4 py-3 whitespace-nowrap">
                            {{ \Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->translatedFormat('j F Y') }}
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @php
                                $badgeColor = '';
                                $badgeText = '';

                                switch ($pengajuan->status) {
                                    case 'DOKUMEN_LENGKAP':
                                        $badgeColor = 'bg-yellow-100 text-yellow-700'; // Menunggu Penugasan
                                        $badgeText = 'Menunggu';
                                        break;
                                    case 'PROSES_SURVEY':
                                        $badgeColor = 'bg-blue-100 text-blue-700'; // Sudah Ditugaskan
                                        $badgeText = 'Ditugaskan';
                                        break;
                                    default: // Seharusnya tidak ada status lain yang muncul karena filter di controller
                                        $badgeColor = 'bg-gray-100 text-gray-700';
                                        $badgeText = $pengajuan->status;
                                        break;
                                }
                            @endphp
                            <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeColor }}">{{ $badgeText }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @if ($pengajuan->status === 'PROSES_SURVEY')
                                <div class="flex items-center text-gray-700">
                                    <svg class="w-4 h-4 mr-1 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h2a2 2 0 002-2V7a2 2 0 00-2-2h-2a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 20h2a2 2 0 002-2V7a2 2 0 00-2-2H9a2 2 0 00-2 2v11a2 2 0 002 2z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 20h2"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20h2"></path>
                                    </svg>
                                    {{ $pengajuan->petugas->user->nama ?? 'Petugas Tidak Ditemukan' }}
                                </div>
                            @elseif ($pengajuan->status === 'DOKUMEN_LENGKAP')
                                @php
                                    $kecamatanId = $pengajuan->kelurahan->kecamatan_id ?? null;
                                    $petugasFiltered = $petugas->filter(function ($p) use ($kecamatanId) {
                                        return $p->kecamatan_id == $kecamatanId;
                                    });
                                @endphp

                                <form action="{{ route('admin.penugasan.tugaskan', $pengajuan->id) }}" method="POST">
                                    @csrf
                                    <div class="relative inline-block">
                                        <select name="petugas_nip" onchange="this.form.submit()"
                                                class="appearance-none border border-gray-300 rounded-lg px-3 py-1.5 text-blue-600 bg-white pr-8 text-sm focus:outline-none focus:ring-1 focus:ring-blue-500">
                                            <option value="">Pilih Petugas</option>
                                            @foreach ($petugasFiltered as $petugasItem)
                                                <option value="{{ $petugasItem->nip }}">
                                                    {{ $petugasItem->user->nama ?? '-' }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-blue-600">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <span class="text-gray-500 text-sm">-</span>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-3 py-6 text-gray-500">Tidak ada pengajuan yang dapat ditugaskan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-end">
            {{ $pengajuans->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection