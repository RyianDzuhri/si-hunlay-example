@extends('admin.layouts.layout')

@section('title', 'Manajemen Pengajuan RTLH')

@section('content')
<div class="p-0.5">
    <div class="mb-6">
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengajuan RTLH</h1>
        <p class="text-gray-600">Kelola dan verifikasi pengajuan rumah tidak layak huni</p>
    </div>

    {{-- Search & Filter --}}
    <form action="{{ route('admin.pengajuan.index') }}" method="GET" class="bg-white p-4 rounded-lg shadow-md mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        {{-- Input Search --}}
        <div class="relative w-full md:w-auto md:flex-1">
            <input
                type="text"
                name="q"
                value="{{ request('q') }}"
                placeholder="Cari berdasarkan nama atau NIK....."
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                onkeydown="if(event.key === 'Enter') this.form.submit()"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>


        <div class="flex flex-col md:flex-row gap-4 w-full md:w-auto">
            {{-- Select Filter Status --}}
            <div class="relative w-full md:w-auto">
                <select name="status" onchange="this.form.submit()" class="appearance-none w-full md:w-40 p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <option value="">Semua Status</option>
                    <option value="DIAJUKAN" {{ request('status') == 'DIAJUKAN' ? 'selected' : '' }}>Menunggu</option>
                    <option value="DOKUMEN_LENGKAP" {{ request('status') == 'DOKUMEN_LENGKAP' ? 'selected' : '' }}>Diverifikasi</option>
                    <option value="PROSES_SURVEY" {{ request('status') == 'PROSES_SURVEY' ? 'selected' : '' }}>Survey</option>
                    <option value="EVALUASI_AKHIR" {{ request('status') == 'EVALUASI_AKHIR' ? 'selected' : '' }}>Evaluasi</option>
                    <option value="DISETUJUI" {{ request('status') == 'DISETUJUI' ? 'selected' : '' }}>Disetujui</option>
                    <option value="DITOLAK" {{ request('status') == 'DITOLAK' ? 'selected' : '' }}>Ditolak</option>
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>

            {{-- Export --}}
            <a href="{{ route('admin.pengajuan.export', request()->query()) }}" class="inline-flex items-center justify-center px-4 py-2 border border-blue-600 rounded-lg text-blue-600 bg-blue-50 hover:bg-blue-100 focus:outline-none focus:ring-1 focus:ring-blue-500">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"></path>
                </svg>
                Export
            </a>
        </div>
    </form>

    {{-- Tabel --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-left text-gray-800">
            <thead class="bg-white border-b border-gray-200 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold text-xs">No</th>
                    <th class="px-4 py-3 font-semibold text-xs">Nama Pemohon</th>
                    <th class="px-4 py-3 font-semibold text-xs">NIK</th>
                    <th class="px-4 py-3 font-semibold text-xs">Alamat</th>
                    <th class="px-4 py-3 font-semibold text-xs">Tanggal Pengajuan</th>
                    <th class="px-4 py-3 font-semibold text-xs">Status</th>
                    <th class="px-4 py-3 font-semibold text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100">
                @forelse ($pengajuan as $index => $item)
                    <tr class="hover:bg-gray-50">
                        <td class="px-4 py-3 whitespace-nowrap">{{ $pengajuan->firstItem() + $index }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <div class="flex items-center gap-3">
                                <div class="bg-blue-600 text-white rounded-full h-8 w-8 flex items-center justify-center text-sm font-medium">
                                    {{ strtoupper(substr($item['nama'], 0, 2)) }}
                                </div>
                                <div>
                                    <div class="font-medium text-gray-900">{{ $item['nama'] }}</div>
                                    <div class="text-xs text-gray-500">{{ $item['kode_pengajuan'] }}</div>
                                </div>
                            </div>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">{{ $item['nik'] }}</td>
                        <td class="px-4 py-3">{{ $item['alamat'] }}</td> {{-- Biarkan wrapping untuk alamat panjang --}}
                        <td class="px-4 py-3 whitespace-nowrap">{{ \Carbon\Carbon::parse($item['tanggal_pengajuan'])->translatedFormat('D, d F Y') }}</td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            @php
                                $badge = match($item['status']) {
                                    'DIAJUKAN' => ['text' => 'Menunggu', 'color' => 'bg-yellow-100 text-yellow-700'],
                                    'DOKUMEN_LENGKAP' => ['text' => 'Diverifikasi', 'color' => 'bg-blue-100 text-blue-700'],
                                    'PROSES_SURVEY' => ['text' => 'Survey', 'color' => 'bg-purple-100 text-purple-700'], // Contoh warna lain
                                    'EVALUASI_AKHIR' => ['text' => 'Evaluasi', 'color' => 'bg-indigo-100 text-indigo-700'], // Contoh warna lain
                                    'DISETUJUI' => ['text' => 'Disetujui', 'color' => 'bg-green-100 text-green-700'],
                                    'DITOLAK' => ['text' => 'Ditolak', 'color' => 'bg-red-100 text-red-700'],
                                    default => ['text' => $item['status'], 'color' => 'bg-gray-100 text-gray-700']
                                };
                            @endphp
                            <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badge['color'] }}">{{ $badge['text'] }}</span>
                        </td>
                        <td class="px-4 py-3 whitespace-nowrap">
                            <a href="{{ route('admin.pengajuan.verifikasi', $item['id']) }}" class="bg-blue-600 text-white text-xs font-medium px-4 py-2 rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                Verifikasi
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center text-gray-500 py-6">Tidak ada data pengajuan.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-6 flex justify-end">
            {{-- Mengubah tampilan pagination default Laravel ke gaya Tailwind CSS --}}
            {{ $pengajuan->onEachSide(1)->links('vendor.pagination.tailwind') }}
        </div>
    </div>
</div>
@endsection