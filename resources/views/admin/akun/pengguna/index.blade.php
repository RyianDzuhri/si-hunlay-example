@extends('admin.layouts.layout')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="p-0.5"> {{-- Konsisten dengan padding halaman lain --}}
    {{-- Header Halaman --}}
    <div class="mb-6">
        <p class="text-sm text-gray-500 mb-1">Manajemen Akun Masyarakat/Warga</p> {{-- Teks tambahan --}}
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pengguna</h1>
    </div>

    {{-- Pencarian --}}
    <form method="GET" action="{{ route('admin.pengguna.index') }}" class="bg-white p-6 rounded-lg shadow-md mb-6">
        <div class="relative w-full md:w-1/3"> {{-- Lebar disesuaikan agar mirip gambar --}}
            <input
                type="text"
                name="search"
                placeholder="Cari nama atau NIK....."
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
    </form>

    {{-- Tabel Pengguna --}}
    <div class="bg-white p-6 rounded-lg shadow-md overflow-x-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-white border-b border-gray-200 text-gray-500 uppercase tracking-wider">
                <tr>
                    <th class="px-4 py-3 font-semibold text-xs">No</th>
                    <th class="px-4 py-3 font-semibold text-xs">Nama Lengkap</th>
                    <th class="px-4 py-3 font-semibold text-xs">NIK</th>
                    <th class="px-4 py-3 font-semibold text-xs">Email</th>
                    <th class="px-4 py-3 font-semibold text-xs">Tanggal Register</th>
                    <th class="px-4 py-3 font-semibold text-xs text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-gray-100 text-gray-700">
                @forelse ($users as $user)
                <tr class="hover:bg-gray-50">
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                    </td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->nama }}</td> {{-- Menghilangkan strtoupper() jika tidak diperlukan lagi --}}
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->warga->nik ?? '-' }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">{{ $user->email }}</td>
                    <td class="px-4 py-3 whitespace-nowrap">
                        {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('j F Y') }}
                    </td>
                    <td class="px-4 py-3 text-center whitespace-nowrap">
                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
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
                    <td colspan="6" class="text-center py-6 text-gray-500">Tidak ada pengguna ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-6 flex justify-end">
        {{ $users->onEachSide(1)->links('vendor.pagination.tailwind') }}
    </div>
</div>
@endsection