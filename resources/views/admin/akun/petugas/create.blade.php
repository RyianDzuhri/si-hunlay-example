@extends('admin.layouts.layout')

@section('title', 'Tambah Petugas')

@section('content')
<div class="container mx-auto px-4 py-6">
    <div class="bg-white p-6 rounded shadow">
        <h2 class="text-xl font-bold mb-4">Tambah Akun Petugas</h2>
        
        <form action="{{ route('admin.akun.petugas.store') }}" method="POST">
            @csrf

            {{-- Nama Lengkap --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Nama Lengkap</label>
                <input type="text" name="nama" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300" />
            </div>

            {{-- Email --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Email</label>
                <input type="email" name="email" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300" />
            </div>

            {{-- Password --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Password</label>
                <input type="password" name="password" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300" />
            </div>

            {{-- NIP --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">NIP</label>
                <input type="text" name="nip" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300" />
            </div>

            {{-- Wilayah Tugas --}}
            {{-- <div class="mb-4">
                <label class="block mb-1 font-semibold">Wilayah Tugas</label>
                <input type="text" name="wilayahTugas" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300" />
            </div> --}}

            {{-- Kecamatan --}}
            <div class="mb-4">
                <label class="block mb-1 font-semibold">Kecamatan</label>
                <select name="kecamatan_id" required class="w-full px-4 py-2 border rounded-lg shadow focus:ring focus:ring-blue-300">
                    <option value="">Pilih Kecamatan</option>
                    @foreach ($kecamatanList as $kecamatan)
                        <option value="{{ $kecamatan->id }}">{{ $kecamatan->nama_kecamatan }}</option>
                    @endforeach
                </select>
            </div>

            {{-- Tombol --}}
            <div class="mt-6">
                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg shadow">
                    Simpan Petugas
                </button>
                <a href="{{ route('admin.akun.petugas.index') }}" class="ml-4 text-gray-600 hover:underline">Batal</a>
            </div>
        </form>
    </div>
</div>
@endsection
