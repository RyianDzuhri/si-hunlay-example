@extends('admin.layouts.layout')

@section('title', 'Manajemen Petugas')

@section('content')
<div class="p-0.5"> {{-- Konsisten dengan padding halaman lain --}}
    {{-- Header Halaman --}}
    <div class="mb-6">
        <p class="text-sm text-gray-500 mb-1">Manajemen Akun Petugas</p> {{-- Teks tambahan --}}
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Petugas</h1>
    </div>

    {{-- Form Pencarian, Filter, dan Tombol Tambah --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-col md:flex-row gap-4 items-center justify-between">
        <form method="GET" action="{{ route('admin.akun.petugas.index') }}" class="flex flex-col md:flex-row gap-4 w-full md:w-auto md:flex-1">
            {{-- Input Pencarian --}}
            <div class="relative flex-1">
                <input
                    type="text"
                    name="search"
                    placeholder="Cari nama atau NIP....."
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

            {{-- Select Filter Wilayah --}}
            <div class="relative w-full md:w-auto">
                <select name="wilayah" onchange="this.form.submit()" class="appearance-none w-full md:w-48 p-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                    <option value="">Semua wilayah</option>
                    @foreach ($wilayahList as $wilayah)
                        <option value="{{ $wilayah }}" {{ request('wilayah') == $wilayah ? 'selected' : '' }}>{{ $wilayah }}</option>
                    @endforeach
                </select>
                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </div>
            </div>
            <button type="submit" class="hidden">Cari</button> {{-- Tombol ini disembunyikan karena sudah auto-submit --}}
        </form>

        <a href="{{ route('admin.akun.petugas.create') }}" class="inline-flex items-center px-4 py-2 bg-blue-600 text-white text-sm font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
            <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Tambah petugas
        </a>
    </div>

    {{-- Tabel Petugas --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b border-gray-200 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold text-xs">NO</th>
                    <th class="px-4 py-3 font-semibold text-xs">NAMA LENGKAP</th>
                    <th class="px-4 py-3 font-semibold text-xs">NIK/NIP</th>
                    <th class="px-4 py-3 font-semibold text-xs">WILAYAH TUGAS</th>
                    <th class="px-4 py-3 font-semibold text-xs text-center">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($petugas as $key => $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ $petugas->firstItem() + $key }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->nama }}</td> {{-- Menghilangkan strtoupper() jika tidak diperlukan lagi --}}
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->petugas->nip ?? '-' }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->petugas->kecamatan->nama_kecamatan ?? '-' }}</td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <form action="{{ route('admin.akun.petugas.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                class="inline-flex items-center justify-center px-4 py-2 bg-red-600 text-white text-xs font-medium rounded-lg hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50 gap-1">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                HAPUS
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-6 text-gray-500">Tidak ada petugas ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-end">
        {{ $petugas->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection