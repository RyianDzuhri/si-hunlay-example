@extends('admin.layouts.layout')

@section('title', 'Tambah Petugas')

@section('content')
<div class="p-0.5"> {{-- Konsisten dengan padding halaman lain --}}
    {{-- Header Halaman --}}
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.akun.petugas.index') }}" class="text-gray-600 hover:text-gray-900 mr-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Akun Petugas</h1>
    </div>

    {{-- Form Card --}}
    <div class="bg-white p-6 rounded-lg shadow-md max-w-2xl mx-auto"> {{-- Max width dan auto margin untuk form --}}
        <h2 class="text-xl font-semibold text-gray-800 mb-6">Informasi Akun Petugas</h2>
        
        <form action="{{ route('admin.akun.petugas.store') }}" method="POST">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-5">
                <label for="nama" class="block text-gray-700 text-sm font-medium mb-1">Nama Lengkap</label>
                <input type="text" id="nama" name="nama" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Masukkan nama lengkap" />
                @error('nama')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Email --}}
            <div class="mb-5">
                <label for="email" class="block text-gray-700 text-sm font-medium mb-1">Email</label>
                <input type="email" id="email" name="email" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Masukkan alamat email" />
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Password --}}
            <div class="mb-5">
                <label for="password" class="block text-gray-700 text-sm font-medium mb-1">Password</label>
                <input type="password" id="password" name="password" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Masukkan password" />
                @error('password')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- NIP --}}
            <div class="mb-5">
                <label for="nip" class="block text-gray-700 text-sm font-medium mb-1">NIP</label>
                <input type="text" id="nip" name="nip" required
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-1 focus:ring-blue-500 placeholder-gray-400"
                       placeholder="Masukkan NIP" />
                @error('nip')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Kecamatan --}}
            <div class="mb-6"> {{-- Gunakan mb-6 untuk jarak lebih sebelum tombol --}}
                <label for="kecamatan_id" class="block text-gray-700 text-sm font-medium mb-1">Kecamatan</label>
                <div class="relative">
                    <select id="kecamatan_id" name="kecamatan_id" required
                            class="appearance-none w-full px-4 py-2 border border-gray-300 rounded-lg bg-white text-gray-800 focus:outline-none focus:ring-1 focus:ring-blue-500 pr-8">
                        <option value="">Pilih Kecamatan</option>
                        @foreach ($kecamatanList as $kecamatan)
                            <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </div>
                </div>
                @error('kecamatan_id')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            {{-- Tombol --}}
            <div class="mt-6 flex justify-start space-x-3"> {{-- justify-start dan space-x-3 untuk tombol --}}
                <button type="submit"
                        class="inline-flex items-center px-6 py-2 bg-blue-600 text-white font-medium rounded-lg shadow hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                    Simpan Petugas
                </button>
                <a href="{{ route('admin.akun.petugas.index') }}"
                   class="inline-flex items-center px-6 py-2 text-gray-700 bg-gray-100 rounded-lg hover:bg-gray-200 font-medium transition duration-150 ease-in-out">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection