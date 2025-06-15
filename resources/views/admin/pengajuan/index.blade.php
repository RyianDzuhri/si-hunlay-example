@extends('admin.layouts.layout')

@section('title', 'Manajemen Pengajuan RTLH')

@section('content')
<div class="p-0.5">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengajuan RTLH</h1>
        <p class="text-gray-600">Kelola dan verifikasi pengajuan rumah tidak layak huni</p>
    </div>

    {{-- Search & Filter --}}
    <form action="{{ route('admin.pengajuan') }}" method="GET" class="bg-white p-4 rounded shadow-sm mb-4 flex flex-col md:flex-row gap-4 justify-between items-center">
        {{-- Input Search --}}
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari berdasarkan nama atau NIK..."
            class="w-full md:w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            onkeydown="if(event.key === 'Enter') this.form.submit()"
        />

        {{-- Select Filter Status --}}
        <div class="flex items-center gap-4">
            <div class="relative">
                <select name="status" onchange="this.form.submit()" class="appearance-none w-40 p-2 border-2 border-blue-600 rounded-lg bg-white text-black focus:outline-none focus:ring focus:ring-blue-200 pr-8">
                    <option value="">Semua Status</option>
                    <option value="DIAJUKAN" {{ request('status') == 'DIAJUKAN' ? 'selected' : '' }}>Menunggu</option>
                    <option value="DOKUMEN_LENGKAP" {{ request('status') == 'DOKUMEN_LENGKAP' ? 'selected' : '' }}>Diverifikasi</option>
                    <option value="PROSES_SURVEY" {{ request('status') == 'PROSES_SURVEY' ? 'selected' : '' }}>Survey</option>
                    <option value="EVALUASI_AKHIR" {{ request('status') == 'EVALUASI_AKHIR' ? 'selected' : '' }}>Evaluasi</option>
                    <option value="DISETUJUI" {{ request('status') == 'DISETUJUI' ? 'selected' : '' }}>Disetujui</option>
                    <option value="DITOLAK" {{ request('status') == 'DITOLAK' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-black">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            {{-- Export --}}
            <a href="{{ route('pengajuan.export', request()->query()) }}" class="inline-flex items-center px-4 py-2 border-2 border-blue-600 rounded-lg text-blue-600 bg-white hover:bg-blue-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export
            </a>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="bg-white p-4 rounded shadow-sm overflow-auto">
        <table class="min-w-full text-sm text-left text-gray-800">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Pemohon</th>
                    <th class="px-4 py-2">NIK</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Tanggal Pengajuan</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @forelse ($pengajuan as $index => $item)
                    <tr class="border-t hover:bg-gray-50">
                        <td class="px-4 py-2">{{ $pengajuan->firstItem() + $index }}</td>
                        <td class="px-4 py-2">
                            <div class="flex items-center gap-2">
                                <div class="bg-blue-600 text-white rounded-full h-8 w-8 flex items-center justify-center">
                                    {{ strtoupper(substr($item['nama'], 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-medium">{{ $item['nama'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $item['kode_pengajuan'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-2">{{ $item['nik'] }}</td>
                        <td class="px-4 py-2">{{ $item['alamat'] }}</td>
                        <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item['tanggal_pengajuan'])->translatedFormat('d F Y') }}</td>
                        <td class="px-4 py-2">
                            @php
                                $badge = match($item['status']) {
                                    'DIAJUKAN' => ['text' => 'Menunggu', 'color' => 'bg-yellow-100 text-yellow-700'],
                                    'DOKUMEN_LENGKAP', 'PROSES_SURVEY', 'EVALUASI_AKHIR' => ['text' => 'Diverifikasi', 'color' => 'bg-blue-100 text-blue-700'],
                                    'DISETUJUI' => ['text' => 'Disetujui', 'color' => 'bg-green-100 text-green-700'],
                                    'DITOLAK' => ['text' => 'Ditolak', 'color' => 'bg-red-100 text-red-700'],
                                    default => ['text' => $item['status'], 'color' => 'bg-gray-100 text-gray-700']
                                };
                            @endphp
                            <span class="text-xs px-3 py-1 rounded-full font-medium {{ $badge['color'] }}">{{ $badge['text'] }}</span>
                        </td>
                        {{-- <td class="px-4 py-2">
                            <a href="{{ route('admin.pengajuan.verifikasi', $item['id']) }}" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                                Detail
                            </a>
                        </td> --}}
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-4">Tidak ada data pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pengajuan->links() }}
        </div>
    </div>
</div>
@endsection
