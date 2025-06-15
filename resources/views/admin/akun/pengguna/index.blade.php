@extends('admin.layouts.layout')

@section('title', 'Manajemen Pengguna')

@section('content')
<div class="container mx-auto px-4 py-6">

    {{-- Judul Halaman --}}
    <h2 class="text-2xl font-semibold mb-4">Manajemen Pengguna</h2>

    {{-- Pencarian --}}
    <form method="GET" action="{{ route('admin.pengguna.index') }}" class="mb-6">
        <div class="relative w-full md:w-1/3">
            <input type="text" name="search" placeholder="Cari nama atau NIK..." value="{{ request('search') }}"
                class="w-full px-4 py-2 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500" />
            <div class="absolute top-2 right-3 text-gray-400">
                <i class="fas fa-search"></i>
            </div>
        </div>
    </form>

    {{-- Tabel Pengguna --}}
    <div class="bg-white shadow rounded overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Lengkap</th>
                    <th class="px-6 py-3">NIK</th>
                    <th class="px-6 py-3">Email</th>
                    <th class="px-6 py-3">Tanggal Register</th>
                    <th class="px-6 py-3 text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                <tr class="border-t">
                    <td class="px-6 py-4">
                        {{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}
                    </td>
                    <td class="px-6 py-4">{{ strtoupper($user->nama) }}</td>
                    <td class="px-6 py-4">{{ $user->warga->nik ?? '-' }}</td>
                    <td class="px-6 py-4">{{ $user->email }}</td>
                    <td class="px-6 py-4">
                        {{ \Carbon\Carbon::parse($user->created_at)->translatedFormat('j F Y') }}
                    </td>
                    <td class="px-6 py-4 text-center">
                        <form action="{{ route('admin.pengguna.destroy', $user->id) }}" method="POST"
                            onsubmit="return confirm('Yakin ingin menghapus pengguna ini?')">
                            @csrf
                            @method('DELETE')
                            <button
                                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded flex items-center justify-center gap-2">
                                <i class="fas fa-trash"></i> HAPUS
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" class="text-center py-4 text-gray-500">Tidak ada pengguna ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->links() }}
    </div>
</div>
@endsection
