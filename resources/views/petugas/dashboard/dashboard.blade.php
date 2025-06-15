@extends('petugas.layout.master')

@section('title', 'Petugas - Dashboard')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-6">
    <h1 class="text-3xl font-bold text-gray-800 mb-2">Halo, {{ $user->name ?? 'Pengguna' }}</h1>
    <p class="text-gray-600 mb-8">Selamat datang di dashboard SI-Hunlay. Berikut ringkasan tugas anda hari ini</p>

    {{-- Ringkasan Tugas --}}
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        {{-- Total Tugas Hari Ini --}}
        <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-4">
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Tugas Anda</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->total }}</p>
            </div>
        </div>

        {{-- Tugas Selesai --}}
        <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-4">
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tugas Selesai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->selesai }}</p>
            </div>
        </div>
        {{-- Tugas Belum Selesai --}}
        <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-4">
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tugas Belum Selesai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->belumSelesai }}</p>
            </div>
        </div>
    </div>

    {{-- Tugas Terbaru --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Tugas Terbaru Diverifikasi</h2>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Warga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tugasTerbaru as $tugas)
                        @php
                            $nama = $tugas->pengajuan->warga->user->nama ?? '-';
                            $lokasi = $tugas->pengajuan->alamat_lengkap . ', Kelurahan ' . ($tugas->pengajuan->kelurahan->nama_kelurahan ?? '-');
                            $status = $tugas->pengajuan->status ?? '-';
                            $tanggal = \Carbon\Carbon::parse($tugas->tgl_survey)->format('d M Y');
                            $inisial = strtoupper(substr($nama, 0, 2));
                        @endphp
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ $inisial }}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $nama }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $lokasi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @php
                                    $labelStatus = match ($status) {
                                        'PROSES_SURVEY' => 'Belum Diverifikasi',
                                        'EVALUASI_AKHIR' => 'Sudah Diverifikasi',
                                        default => 'Menunggu',
                                    };
                                @endphp

                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    {{ $status == 'PROSES_SURVEY' ? 'bg-red-100 text-red-800' : 
                                    ($status == 'EVALUASI_AKHIR' ? 'bg-green-100 text-green-800' : 
                                    'bg-yellow-100 text-yellow-800') }}">
                                    {{ $labelStatus }}
                                </span>
                            </td>

                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $tanggal }}
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
