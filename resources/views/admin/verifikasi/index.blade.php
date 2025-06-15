@extends('admin.layouts.layout')

@section('title', 'Review Hasil Verifikasi Lapangan')

@section('content')
<div class="p-0.5"> {{-- Mengurangi padding keseluruhan agar lebih mirip gambar --}}
    <h1 class="text-2xl font-bold mb-2 text-gray-900">Review Hasil Verifikasi Lapangan</h1>
    <p class="text-gray-600 mb-6">Kelola dan tinjau hasil verifikasi RTLH oleh petugas lapangan</p>

    {{-- Filter dan Search --}}
    <form method="GET" action="{{ route('admin.verifikasi.index') }}" class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-col md:flex-row gap-4 items-center">
        {{-- Search Input --}}
        <div class="relative flex-1 w-full md:w-auto">
            <input
                type="text"
                name="search"
                placeholder="Cari nama pemohon"
                value="{{ request('search') }}"
                class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500"
                onkeydown="if(event.key === 'Enter') this.form.submit()"
            />
            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path>
                </svg>
            </div>
        </div>

        {{-- Status Filter --}}
        <div class="relative w-full md:w-auto">
            <select name="status" onchange="this.form.submit()" class="appearance-none w-full md:w-40 p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                <option value="">Semua Status</option>
                {{-- Opsi status ini merujuk pada status_rekomendasi di HasilSurvey --}}
                <option value="Layak" {{ request('status') == 'Layak' ? 'selected' : '' }}>Layak</option>
                <option value="Tidak Layak" {{ request('status') == 'Tidak Layak' ? 'selected' : '' }}>Tidak Layak</option>
                {{-- Status 'Di Review' di UI bisa jadi merupakan nilai default jika status_rekomendasi belum diisi atau kosong --}}
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>

        {{-- Petugas Filter --}}
        <div class="relative w-full md:w-auto">
            <select name="petugas" onchange="this.form.submit()" class="appearance-none w-full md:w-40 p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                <option value="">Semua Petugas</option>
                @foreach ($petugasList as $petugas)
                    <option value="{{ $petugas->nip }}" {{ request('petugas') == $petugas->nip ? 'selected' : '' }}>
                        {{ $petugas->user->nama }}
                    </option>
                @endforeach
            </select>
            <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                </svg>
            </div>
        </div>
    </form>

    {{-- Table --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b border-gray-200 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold text-xs">No</th>
                    <th class="px-4 py-3 font-semibold text-xs">Nama Pemohon</th>
                    <th class="px-4 py-3 font-semibold text-xs">Alamat</th>
                    <th class="px-4 py-3 font-semibold text-xs">Nama Petugas</th>
                    <th class="px-4 py-3 font-semibold text-xs">Tanggal Verifikasi</th>
                    <th class="px-4 py-3 font-semibold text-xs">Status Verifikasi</th>
                    <th class="px-4 py-3 font-semibold text-xs">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($verifikasiList as $key => $data)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">{{ $verifikasiList->firstItem() + $key }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ optional($data->pengajuan->warga->user)->nama ?? '-' }}
                    </td>
                    <td class="px-4 py-3">
                        {{ $data->pengajuan->alamat_lengkap ?? '-' }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ $data->petugas->user->nama ?? '-' }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ optional($data->tgl_survey)->translatedFormat('j F Y') }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        @php
                            $badgeColor = 'bg-gray-100 text-gray-700'; // Default
                            $statusText = 'Belum Diverifikasi'; // Default untuk yang belum diisi

                            // Map status dari database ke tampilan UI (ini adalah status rekomendasi surveyor)
                            switch ($data->status_rekomendasi) {
                                case 'Layak':
                                    $badgeColor = 'bg-green-100 text-green-700';
                                    $statusText = 'Layak';
                                    break;
                                case 'Tidak Layak':
                                    $badgeColor = 'bg-red-100 text-red-700';
                                    $statusText = 'Tidak Layak';
                                    break;
                                default:
                                    // Jika status_rekomendasi kosong/null (belum diisi surveyor), anggap 'Di Review'
                                    $badgeColor = 'bg-yellow-100 text-yellow-700';
                                    $statusText = 'Di Review';
                                    break;
                            }
                        @endphp
                        <span class="text-xs font-medium px-3 py-1 rounded-full {{ $badgeColor }}">
                            {{ $statusText }}
                        </span>
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{-- ✅ Perubahan di sini: Tampilkan status final pengajuan --}}
                        @if ($data->pengajuan->status == 'DISETUJUI')
                            <span class="text-green-600 font-medium text-sm">Telah Disetujui</span>
                        @elseif ($data->pengajuan->status == 'DITOLAK')
                            <span class="text-red-600 font-medium text-sm">Telah Ditolak</span>
                        @else
                            {{-- Jika status pengajuan belum DISETUJUI atau DITOLAK, tampilkan tombol Lihat Detail --}}
                            <a href="{{ route('admin.verifikasi.show', $data->id) }}"
                                class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-xs font-medium rounded-lg hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                                <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                </svg>
                                Lihat Detail
                            </a>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-6 text-gray-500">Tidak ada data verifikasi ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-end">
        {{ $verifikasiList->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection