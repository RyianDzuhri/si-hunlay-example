@extends('petugas.layout.master')

@section('title', 'Petugas - Daftar Tugas')

@section('content')
<div class="p-6 bg-gray-50 min-h-screen">
    <div class="bg-white p-8 rounded-2xl shadow-lg">

        {{-- HEADER --}}
        <div>
            <h2 class="text-3xl font-bold text-gray-800">Daftar Tugas Verifikasi RTLH</h2>
            <p class="mt-1 text-gray-500">Kelola dan pantau tugas verifikasi rumah tidak layak huni</p>
        </div>

        {{-- GANTI BAGIAN FILTER LAMA ANDA DENGAN INI --}}
        <div class="mt-8 p-6 bg-gray-50 rounded-xl border">
            <form action="{{ route('petugas.tugas') }}" method="GET"> {{-- Sesuaikan nama route --}}
                <div class="flex flex-col md:flex-row md:items-end gap-x-4 gap-y-4">
                    
                    {{-- Filter Status --}}
                    <div class="flex-1">
                        <label for="status_verifikasi" class="block text-sm font-medium text-gray-700 mb-1">Status Verifikasi</label>
                        <select id="status_verifikasi" name="status_verifikasi" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option value="">Semua Status</option>
                            <option value="PROSES_SURVEY">Proses Survei</option>
                            <option value="EVALUASI_AKHIR">Evaluasi Akhir</option>
                            <option value="DISETUJUI">Disetujui</option>
                            <option value="DITOLAK">Ditolak</option>
                        </select>
                    </div>

                    {{-- Filter Tanggal --}}
                    <div class="flex-1">
                        <label for="tanggal_pengajuan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal Pengajuan</label>
                        <input type="date" name="tanggal_pengajuan" id="tanggal_pengajuan" class="block w-full shadow-sm sm:text-sm border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 py-2">
                    </div>

                    {{-- Filter Lokasi --}}
                    <div class="flex-1">
                        <label for="lokasi" class="block text-sm font-medium text-gray-700 mb-1">Lokasi</label>
                        <select id="lokasi" name="lokasi" class="block w-full pl-3 pr-10 py-2 text-base border-gray-300 focus:outline-none focus:ring-blue-500 focus:border-blue-500 sm:text-sm rounded-md shadow-sm">
                            <option>Semua Lokasi</option>
                            {{-- Opsi lokasi (kecamatan/kelurahan) bisa di-loop di sini --}}
                        </select>
                    </div>
                    
                    {{-- Tombol Terapkan Filter --}}
                    <div class="flex-shrink-0">
                        <button type="submit" class="w-full md:w-auto inline-flex items-center justify-center px-6 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 4a1 1 0 011-1h16a1 1 0 011 1v2.586a1 1 0 01-.293.707l-6.414 6.414a1 1 0 00-.293.707V17l-4 4v-6.586a1 1 0 00-.293-.707L3.293 7.293A1 1 0 013 6.586V4z" /></svg>
                            Terapkan Filter
                        </button>
                    </div>

                </div>
            </form>
        </div>
        {{-- AKHIR BAGIAN FILTER --}}

        {{-- TABLE SECTION --}}
        <div class="mt-8">
            <div class="flex justify-between items-center mb-4">
                <h3 class="text-xl font-bold text-gray-800">Daftar Tugas Verifikasi</h3>
            </div>
            
            <div class="overflow-x-auto bg-white rounded-lg shadow">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">No</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama Pemohon</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Alamat</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Pengajuan</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse ($daftarTugas as $tugas)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $loop->iteration + ($daftarTugas->currentPage() - 1) * $daftarTugas->perPage() }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <div class="flex-shrink-0 h-10 w-10 bg-blue-600 text-white flex items-center justify-center rounded-full font-bold">
                                            {{-- Kode untuk membuat inisial nama --}}
                                            @php
                                                $words = explode(' ', $tugas->warga->user->nama);
                                                $initials = strtoupper(substr($words[0], 0, 1) . (count($words) > 1 ? substr(end($words), 0, 1) : ''));
                                            @endphp
                                            {{ $initials }}
                                        </div>
                                        <div class="ml-4">
                                            <div class="text-sm font-medium text-gray-900">{{ $tugas->warga->user->nama_ }}</div>
                                            <div class="text-xs text-gray-500">RTLH-{{ str_pad($tugas->id, 6, '0', STR_PAD_LEFT) }}</div>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-700">{{ $tugas->alamat_lengkap }}</td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ \Carbon\Carbon::parse($tugas->tgl_pengajuan)->translatedFormat('j F Y') }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @php
                                        $statusClass = '';
                                        $statusText = '';
                                        switch ($tugas->status) {
                                            case 'PROSES_SURVEY':
                                                $statusClass = 'bg-yellow-100 text-yellow-800';
                                                $statusText = 'Proses Survei';
                                                break;
                                            case 'EVALUASI_AKHIR':
                                                $statusClass = 'bg-blue-100 text-blue-800';
                                                $statusText = 'Evaluasi';
                                                break;
                                            case 'DISETUJUI':
                                                $statusClass = 'bg-green-100 text-green-800';
                                                $statusText = 'Selesai';
                                                break;
                                            case 'DITOLAK':
                                                $statusClass = 'bg-red-100 text-red-800';
                                                $statusText = 'Selesai';
                                                break;
                                            default:
                                                $statusClass = 'bg-gray-100 text-gray-800';
                                                $statusText = 'Lainnya';
                                        }
                                    @endphp
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full {{ $statusClass }}">
                                        {{ $statusText }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                    <a href="{{ route('petugas.verifikasi', ['id' => $tugas->id]) }}" class="text-white bg-blue-600 hover:bg-blue-700 px-4 py-2 rounded-md">Verifikasi</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-gray-500">
                                    Tidak ada tugas verifikasi untuk Anda saat ini.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
             {{-- PAGINATION LINKS --}}
             <div class="mt-6">
                {{ $daftarTugas->links() }}
            </div>
        </div>
    </div>
</div>
@endsection