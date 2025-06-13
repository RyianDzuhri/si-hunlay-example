
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
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Total Tugas Hari Ini</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->total }}</p>
                <p class="text-sm text-green-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    50% dari bulan lalu
                </p>
            </div>
        </div>

        {{-- Tugas Berlangsung --}}
        <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-4">
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tugas Berlangsung</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->berlangsung }}</p>
                <p class="text-sm text-green-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    50% dari bulan lalu
                </p>
            </div>
        </div>

        {{-- Tugas Selesai --}}
        <div class="bg-white shadow rounded-lg p-6 flex items-start space-x-4">
            <div class="bg-blue-100 rounded-full p-3">
                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 2H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
            </div>
            <div>
                <p class="text-sm text-gray-500">Tugas Selesai</p>
                <p class="text-2xl font-bold text-gray-800">{{ $ringkasanTugas->selesai }}</p>
                <p class="text-sm text-green-500 flex items-center">
                    <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18"></path></svg>
                    50% dari bulan lalu
                </p>
            </div>
        </div>
    </div>

    {{-- Tugas Terbaru --}}
    <div class="bg-white shadow rounded-lg p-6">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold text-gray-800">Tugas Terbaru</h2>
            <a href="#" class="text-blue-600 hover:text-blue-800 text-sm">Lihat Semua</a>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Warga</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lokasi</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($tugasTerbaru as $tugas)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="flex-shrink-0 h-10 w-10 bg-blue-500 rounded-full flex items-center justify-center text-white font-bold text-sm">
                                        {{ substr($tugas->nama_warga, 0, 2) }} {{-- Inisial --}}
                                    </div>
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">{{ $tugas->nama_warga }}</div>
                                        <div class="text-sm text-gray-500">{{ $tugas->kode_pengajuan }}</div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $tugas->lokasi }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $tugas->status == 'Selesai' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                    {{ $tugas->status }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                {{ $tugas->tanggal }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="#" class="text-blue-600 hover:text-blue-900">Lihat Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        {{-- Pagination (contoh sederhana) --}}
        <nav class="bg-white px-4 py-3 flex items-center justify-between border-t border-gray-200 sm:px-6">
            <div class="flex-1 flex justify-between sm:justify-end">
                <a href="#" class="relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Previous
                </a>
                <a href="#" class="ml-3 relative inline-flex items-center px-4 py-2 border border-gray-300 text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                    Next
                </a>
            </div>
        </nav>
    </div>
</div>
@endsection
