@extends('admin.layouts.layout')

@section('title', 'Manajemen Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Form Pencarian dan Filter --}}
    <div class="flex flex-col md:flex-row gap-4 mb-4 items-center justify-between">
        <form method="GET" action="{{ route('admin.akun.petugas.index') }}" class="flex gap-4 w-full md:w-auto">
            <input type="text" name="search" placeholder="Cari nama atau NIP" value="{{ request('search') }}"
                class="px-4 py-2 border rounded-lg w-full md:w-64 focus:ring-2 focus:ring-blue-500 outline-none shadow" />
            <select name="wilayah" class="px-4 py-2 border rounded-lg focus:ring-2 focus:ring-blue-500 shadow">
                <option value="">Semua wilayah</option>
                {{-- Tambahkan opsi dinamis jika ada --}}
            </select>
            <button type="submit" class="hidden">Cari</button>
        </form>

        <a href="#" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow flex items-center">
            <i class="fas fa-plus mr-2"></i> Tambah petugas
        </a>
    </div>

    {{-- Tabel Petugas --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">NO</th>
                    <th class="px-6 py-3">NAMA LENGKAP</th>
                    <th class="px-6 py-3">NIK/NIP</th>
                    <th class="px-6 py-3">WILAYAH TUGAS</th>
                    <th class="px-6 py-3 text-center">AKSI</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($petugas as $key => $item)
                <tr class="border-t">
                    <td class="px-6 py-4">
                        {{ $petugas->firstItem() + $key }}
                    </td>
                    <td class="px-6 py-4">{{ strtoupper($item->nama) }}</td>
                    <td class="px-6 py-4">{{ $item->nip ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $item->wilayah ?? '-' }}</td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.akun.petugas.destroy', $item->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus petugas ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center gap-2">
                                <i class="fas fa-trash"></i> HAPUS
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" class="text-center py-4 text-gray-500">Tidak ada petugas ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $petugas->links() }}
    </div>
</div>
@endsection
