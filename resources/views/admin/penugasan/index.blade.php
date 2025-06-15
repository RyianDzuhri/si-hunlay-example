@extends('admin.layouts.layout')

@section('title', 'Distribusi Tugas Verifikasi Lapangan')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-2">Distribusi Tugas Verifikasi Lapangan</h1>
    <p class="text-gray-600 mb-6">Kelola dan distribusikan tugas verifikasi lapangan kepada petugas</p>

    {{-- Filter --}}
    <form method="GET" action="{{ route('admin.penugasan.index') }}" class="bg-white p-4 rounded-lg shadow-sm flex flex-wrap gap-4 mb-6">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-gray-700 mb-1">Kecamatan</label>
            <select name="kecamatan_id" class="w-full border rounded px-3 py-2">
                <option value="">Semua Wilayah</option>
                @foreach ($kecamatans as $kecamatan)
                    <option value="{{ $kecamatan->id }}" {{ request('kecamatan_id') == $kecamatan->id ? 'selected' : '' }}>
                        {{ $kecamatan->nama_kecamatan }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="flex flex-col">
            <label class="text-gray-700 mb-1">Tanggal Pengajuan</label>
            <div class="flex gap-2">
                <input type="date" class="border rounded px-3 py-2" name="tanggal_awal" value="{{ request('tanggal_awal') }}">
                <span class="py-2">s/d</span>
                <input type="date" class="border rounded px-3 py-2" name="tanggal_akhir" value="{{ request('tanggal_akhir') }}">
            </div>
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-gray-700 mb-1">Status Verifikasi</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option value="">Semua Status</option>
                <option value="MENUNGGU" {{ request('status') == 'MENUNGGU' ? 'selected' : '' }}>Menunggu</option>
                <option value="PROSES_SURVEY" {{ request('status') == 'PROSES_SURVEY' ? 'selected' : '' }}>Proses Survey</option>
                <option value="SELESAI" {{ request('status') == 'SELESAI' ? 'selected' : '' }}>Selesai</option>
            </select>
        </div>
        <div class="flex items-end">
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Terapkan Filter</button>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white p-4 rounded-lg shadow overflow-auto">
        <table class="min-w-full text-sm text-left table-auto">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-3 py-2">NO</th>
                    <th class="px-3 py-2">ID PENGAJUAN</th>
                    <th class="px-3 py-2">NAMA PENGAJU</th>
                    <th class="px-3 py-2">ALAMAT LENGKAP</th>
                    <th class="px-3 py-2">TANGGAL PENGAJUAN</th>
                    <th class="px-3 py-2">STATUS VERIFIKASI</th>
                    <th class="px-3 py-2">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                @forelse ($pengajuans as $index => $pengajuan)
                    <tr>
                        <td class="px-3 py-2">{{ $index + $pengajuans->firstItem() }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->kode_pengajuan }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->warga->user->nama ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->alamat_lengkap }}</td>
                        <td class="px-3 py-2">
                            {{ \Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->translatedFormat('j F Y') }}
                        </td>
                        <td class="px-3 py-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold
                                {{ $pengajuan->status === 'PROSES_SURVEY' ? 'bg-blue-200 text-blue-800' : 'bg-yellow-200 text-yellow-800' }}">
                                {{ $pengajuan->status === 'PROSES_SURVEY' ? 'PROSES SURVEY' : 'Disetujui' }}
                            </span>
                        </td>
                        <td class="px-3 py-2">
                            @if ($pengajuan->status === 'PROSES_SURVEY' && $pengajuan->petugas)
                                Ditugaskan ke: {{ $pengajuan->petugas->user->nama ?? '-' }}
                            @else
                                @php
                                    $kecamatanId = $pengajuan->kelurahan->kecamatan_id ?? null;
                                    $petugasFiltered = $petugas->filter(function ($p) use ($kecamatanId) {
                                        return $p->kecamatan_id == $kecamatanId;
                                    });
                                @endphp

                                <form action="{{ route('admin.penugasan.tugaskan', $pengajuan->id) }}" method="POST">
                                    @csrf
                                    <select name="petugas_nip" onchange="this.form.submit()" class="border px-2 py-1 rounded">
                                        <option value="">-- Pilih Petugas --</option>
                                        @foreach ($petugasFiltered as $petugasItem)
                                            <option value="{{ $petugasItem->nip }}">
                                                {{ $petugasItem->user->nama ?? '-' }}
                                            </option>
                                        @endforeach
                                    </select>
                                </form>
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-3 py-2">Belum ada pengajuan yang disetujui.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pengajuans->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
