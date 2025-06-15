@extends('admin.layouts.layout')

@section('title', 'Review Hasil Verifikasi Lapangan')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-1">Review Hasil Verifikasi Lapangan</h1>
    <p class="text-gray-600 mb-4">Kelola dan tinjau hasil verifikasi RTLH oleh petugas lapangan</p>

    {{-- Filter dan Search --}}
    <form method="GET" class="flex flex-col md:flex-row gap-4 mb-6">
        <input type="text" name="search" placeholder="Cari nama pemohon" value="{{ request('search') }}"
            class="w-full md:w-1/3 px-4 py-2 border rounded shadow focus:outline-none focus:ring-2 focus:ring-blue-500" />

        <select name="status" onchange="this.form.submit()" class="px-4 py-2 border rounded shadow focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Status</option>
            @foreach ($statusList as $status)
                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                    {{ $status }}
                </option>
            @endforeach
        </select>

        <select name="petugas" onchange="this.form.submit()" class="px-4 py-2 border rounded shadow focus:ring-2 focus:ring-blue-500">
            <option value="">Semua Petugas</option>
            @foreach ($petugasList as $petugas)
                <option value="{{ $petugas->nip }}" {{ request('petugas') == $petugas->nip ? 'selected' : '' }}>
                    {{ $petugas->user->nama }}
                </option>
            @endforeach
        </select>
    </form>

    {{-- Table --}}
    <div class="bg-white rounded shadow overflow-x-auto">
        <table class="min-w-full table-auto text-sm text-left text-gray-700">
            <thead class="bg-gray-100 text-gray-600 uppercase text-sm">
                <tr>
                    <th class="px-6 py-3">No</th>
                    <th class="px-6 py-3">Nama Pemohon</th>
                    <th class="px-6 py-3">Alamat</th>
                    <th class="px-6 py-3">Nama Petugas</th>
                    <th class="px-6 py-3">Tanggal Verifikasi</th>
                    <th class="px-6 py-3">Status Verifikasi</th>
                    <th class="px-6 py-3">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($verifikasiList as $key => $data)
                <tr class="border-t">
                    <td class="px-6 py-4">{{ $verifikasiList->firstItem() + $key }}</td>
                    <td class="px-6 py-4">
                        {{ strtoupper(optional($data->pengajuan->warga->user)->nama ?? '-') }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->pengajuan->alamat_lengkap ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $data->petugas->user->nama ?? '-' }}
                    </td>
                    <td class="px-6 py-4">
                        {{ optional($data->tgl_survey)->translatedFormat('j F Y') }}
                    </td>
                    <td class="px-6 py-4">
                        <span class="px-3 py-1 rounded-full text-xs font-semibold
                            {{ $data->status_rekomendasi === 'Di Review' ? 'bg-yellow-100 text-yellow-700' : ($data->status_rekomendasi === 'Diterima' ? 'bg-green-100 text-green-700' : 'bg-red-100 text-red-700') }}">
                            {{ $data->status_rekomendasi }}
                        </span>
                    </td>
                    <td class="px-6 py-4">
                        <a href="{{ route('admin.verifikasi.show', $data->id) }}"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded text-sm inline-flex items-center">
                             <i class="fas fa-eye mr-2"></i> Lihat Detail
                         </a>                         
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" class="text-center py-4 text-gray-500">Tidak ada data verifikasi ditemukan.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $verifikasiList->links() }}
    </div>
</div>
@endsection
