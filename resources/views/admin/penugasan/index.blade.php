@extends('admin.layouts.layout')

@section('title', 'Distribusi Tugas Verifikasi Lapangan')

@section('content')
<div class="p-6">
    <h1 class="text-2xl font-bold mb-2">Distribusi Tugas Verifikasi Lapangan</h1>
    <p class="text-gray-600 mb-6">Kelola dan distribusikan tugas verifikasi lapangan kepada petugas</p>

    {{-- Filter --}}
    <div class="bg-white p-4 rounded-lg shadow-sm flex flex-wrap gap-4 mb-6">
        <div class="flex-1 min-w-[200px]">
            <label class="block text-gray-700 mb-1">Kecamatan/Kelurahan</label>
            <select name="kecamatan" class="w-full border rounded px-3 py-2">
                <option>Semua Wilayah</option>
                {{-- Loop dari controller --}}
            </select>
        </div>
        <div class="flex flex-col">
            <label class="text-gray-700 mb-1">Tanggal Pengajuan</label>
            <div class="flex gap-2">
                <input type="date" class="border rounded px-3 py-2" name="tanggal_awal">
                <span class="py-2">s/d</span>
                <input type="date" class="border rounded px-3 py-2" name="tanggal_akhir">
            </div>
        </div>
        <div class="flex-1 min-w-[200px]">
            <label class="block text-gray-700 mb-1">Status Verifikasi</label>
            <select name="status" class="w-full border rounded px-3 py-2">
                <option>Semua Status</option>
                <option value="MENUNGGU">Menunggu</option>
                <option value="TERJADWAL">Terjadwal</option>
                <option value="SELESAI">Selesai</option>
            </select>
        </div>
    </div>

    {{-- Table --}}
    <div class="bg-white p-4 rounded-lg shadow overflow-auto">
        <table class="min-w-full text-sm text-left table-auto">
            <thead class="bg-gray-100 text-gray-700 font-semibold">
                <tr>
                    <th class="px-3 py-2">NO</th>
                    <th class="px-3 py-2">ID PENGAJUAN</th>
                    <th class="px-3 py-2">NAMA PENGAJU</th>
                    <th class="px-3 py-2">ALAMAT LENGKAP</th>
                    <th class="px-3 py-2">TANGGAL PENGAJUAN</th>
                    <th class="px-3 py-2">STATUS VERIFIKASI</th>
                    <th class="px-3 py-2">AKSI</th>
                </tr>
            </thead>
            <tbody class="divide-y text-gray-700">
                @forelse ($pengajuans as $index => $pengajuan)
                    <tr>
                        <td class="px-3 py-2">{{ $index + $pengajuans->firstItem() }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->kode_pengajuan }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->warga->user->name ?? '-' }}</td>
                        <td class="px-3 py-2">{{ $pengajuan->alamat_lengkap }}</td>
                        <td class="px-3 py-2">
                            {{ \Carbon\Carbon::parse($pengajuan->tgl_pengajuan)->translatedFormat('j F Y') }}
                        </td>
                        <td class="px-3 py-2">
                            <span class="px-3 py-1 rounded-full text-xs font-semibold bg-yellow-200 text-yellow-800">
                                Disetujui
                            </span>
                        </td>
                        <td class="px-3 py-2">
                            <form action="{{ route('admin.penugasan.tugaskan', $pengajuan->id) }}" method="POST">
                                @csrf
                                @method('PUT')

                                <select name="petugas_nip" class="border px-2 py-1 rounded text-sm" required>
                                    <option value="">-- Pilih Petugas --</option>
                                    @foreach (collect($petugas)->where('wilayahTugas', $pengajuan->kelurahan->kecamatan->nama_kecamatan) as $petugasTerkait)
                                        <option value="{{ $petugasTerkait->nip }}">
                                            {{ $petugasTerkait->user->name }}
                                        </option>
                                    @endforeach
                                </select>
                                

                                <button type="submit" class="ml-2 px-2 py-1 bg-blue-500 text-white rounded text-sm">
                                    Tugaskan
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center px-3 py-2">Belum ada pengajuan yang disetujui.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Pagination --}}
        <div class="mt-4">
            {{ $pengajuans->links() }}
        </div>
    </div>
</div>
@endsection
