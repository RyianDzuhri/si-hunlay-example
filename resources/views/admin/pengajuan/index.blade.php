@extends('admin.layouts.layout')

@section('title', 'Pengajuan Bantuan')

@section('content')
<div class="p-0.5">
    <div class="mb-6">
        <h1 class="text-2xl font-bold">Manajemen Pengajuan Bantuan</h1>
        <p class="text-gray-600">Kelola dan verifikasi pengajuan bantuan dari warga</p>
    </div>

    <!-- Search & Filter -->
    {{-- <div class="bg-white p-4 rounded shadow-sm mb-4 flex flex-col md:flex-row gap-4 justify-between items-center">
        <input
            type="text"
            placeholder="Cari berdasarkan nama atau NIK..."
            class="w-full md:w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
        />

        <div class="flex items-center gap-4">
            <select class="p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                <option>Semua Status</option>
                <option>Menunggu</option>
                <option>Diverifikasi</option>
                <option>Ditolak</option>
            </select>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Export
            </button>
        </div>
    </div> --}}

    <form action="{{ route('admin.pengajuan') }}" method="GET" class="bg-white p-4 rounded shadow-sm mb-4 flex flex-col md:flex-row gap-4 justify-between items-center">
        {{-- Input pencarian nama/NIK --}}
        <input
            type="text"
            name="q"
            value="{{ request('q') }}"
            placeholder="Cari berdasarkan nama atau NIK..."
            class="w-full md:w-1/2 p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200"
            onkeydown="if(event.key === 'Enter') this.form.submit()"
        />
    
        <div class="flex items-center gap-4">
            {{-- Dropdown status --}}
            <select name="status" onchange="this.form.submit()" class="p-2 border border-gray-300 rounded focus:outline-none focus:ring focus:ring-blue-200">
                <option value="">Semua Status</option>
                <option value="Menunggu" {{ request('status') == 'Menunggu' ? 'selected' : '' }}>Menunggu</option>
                <option value="Diverifikasi" {{ request('status') == 'Diverifikasi' ? 'selected' : '' }}>Diverifikasi</option>
                <option value="Ditolak" {{ request('status') == 'Ditolak' ? 'selected' : '' }}>Ditolak</option>
            </select>
    
            {{-- Tombol Export --}}
            {{-- <a href="{{ route('pengajuan.index', array_merge(request()->query(), ['export' => 1])) }}" class="btn btn-success">
                Export
            </a>  --}}
            <a href="{{ route('pengajuan.export', request()->query()) }}" class="btn btn-success">Export</a>
           
        </div>
    </form>
    

    <!-- Tabel -->
    <div class="bg-white p-4 rounded shadow-sm overflow-auto">
        <table class="min-w-full text-sm text-left">
            <thead class="bg-gray-100 text-gray-600 font-semibold">
                <tr>
                    <th class="px-4 py-2">No</th>
                    <th class="px-4 py-2">Nama Pemohon</th>
                    <th class="px-4 py-2">NIK</th>
                    <th class="px-4 py-2">Alamat</th>
                    <th class="px-4 py-2">Tanggal Pengajuan</th>
                    <th class="px-4 py-2">Status</th>
                    <th class="px-4 py-2">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-gray-700">
                @foreach ($pengajuan as $index => $item)
                <tr class="border-t">
                    <td class="px-4 py-2">{{ $index + 1 }}</td>
                    <td class="px-4 py-2">
                        <div class="flex items-center gap-2">
                            <div class="bg-blue-600 text-white rounded-full h-8 w-8 flex items-center justify-center">
                                {{ strtoupper(substr($item['nama'], 0, 2)) }}
                            </div>
                            <div>
                                <div class="font-medium">{{ $item['nama'] }}</div>
                                <div class="text-xs text-gray-500">{{ $item['kode_pengajuan'] }}</div>
                            </div>
                        </div>
                    </td>
                    <td class="px-4 py-2">{{ $item['nik'] }}</td>
                    <td class="px-4 py-2">{{ $item['alamat'] }}</td>
                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($item['tanggal_pengajuan'])->translatedFormat('d F Y') }}</td>
                    <td class="px-4 py-2">
                        @if ($item['status'] == 'Menunggu')
                            <span class="bg-yellow-100 text-yellow-700 px-2 py-1 rounded text-xs">Menunggu</span>
                        @elseif ($item['status'] == 'Diverifikasi')
                            <span class="bg-green-100 text-green-700 px-2 py-1 rounded text-xs">Diverifikasi</span>
                        @else
                            <span class="bg-red-100 text-red-700 px-2 py-1 rounded text-xs">Ditolak</span>
                        @endif
                    </td>
                    <td class="px-4 py-2">
                        <a href="#" class="bg-blue-500 text-white px-3 py-1 rounded text-xs hover:bg-blue-600">
                            Detail
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $pengajuan->links() }}
        </div>
    </div>
</div>
@endsection
