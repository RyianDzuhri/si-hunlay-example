@extends('admin.layouts.layout')

@section('title', 'Detail Verifikasi')

@section('content')
<div class="p-0.5"> {{-- Konsisten dengan padding halaman lain --}}
    {{-- Header Halaman --}}
    <div class="mb-6 flex items-center">
        <a href="{{ route('admin.verifikasi.index') }}" class="text-gray-600 hover:text-gray-900 mr-3">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
            </svg>
        </a>
        <h1 class="text-2xl font-bold text-gray-900">Verifikasi Hasil Lapangan</h1>
    </div>

    {{-- Main Content Card --}}
    <div class="bg-white p-6 rounded-lg shadow-md mb-6">
        <h2 class="text-xl font-semibold text-gray-800 mb-4 border-b pb-3">Informasi Hasil Survei</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-8 gap-y-4 text-gray-700 mb-6">
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Tanggal Survei</p>
                <p class="font-medium">{{ optional($hasil->tgl_survey)->translatedFormat('j F Y') ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Status Kepemilikan</p>
                <p class="font-medium">{{ $hasil->status_kepemilikan ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Kondisi Ekonomi</p>
                <p class="font-medium">{{ $hasil->verifikasi_ekonomi ?? '-' }}</p>
            </div>
            <div>
                <p class="text-gray-500 text-sm mb-0.5">Rekomendasi</p>
                <p class="font-medium">
                    @php
                        $recommendationColor = 'bg-gray-100 text-gray-700';
                        $recommendationText = $hasil->status_rekomendasi ?? '-';
                        switch ($hasil->status_rekomendasi) {
                            case 'Layak':
                                $recommendationColor = 'bg-green-100 text-green-700';
                                break;
                            case 'Tidak Layak':
                                $recommendationColor = 'bg-red-100 text-red-700';
                                break;
                            case 'Pending': // Jika ada status pending atau sejenisnya
                                $recommendationColor = 'bg-yellow-100 text-yellow-700';
                                break;
                        }
                    @endphp
                    <span class="text-xs font-medium px-3 py-1 rounded-full {{ $recommendationColor }}">
                        {{ $recommendationText }}
                    </span>
                </p>
            </div>
            <div class="md:col-span-2">
                <p class="text-gray-500 text-sm mb-0.5">Catatan Survei</p>
                <p class="font-medium">{{ $hasil->catatan_survei ?? '-' }}</p>
            </div>
        </div>

        <h3 class="text-lg font-semibold text-gray-800 mb-3 border-t pt-4">Dokumen yang Diverifikasi</h3>
        <ul class="list-none space-y-2 text-gray-700">
            @forelse ($hasil->detail_verifikasi_dokumen as $dok)
                <li class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span>{{ $dok }}</span>
                </li>
            @empty
                <li class="text-gray-500 italic">Tidak ada dokumen yang diverifikasi.</li>
            @endforelse
        </ul>

        <h3 class="text-lg font-semibold text-gray-800 mt-6 mb-3 border-t pt-4">Bukti Survei</h3>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
            @forelse ($hasil->bukti_survei as $img)
                <div class="relative flex flex-col items-center justify-between border border-gray-200 rounded-lg overflow-hidden bg-gray-50 hover:shadow-md transition-shadow duration-200 group">
                    <img src="{{ asset('storage/' . $img) }}" alt="Bukti Survei" class="w-full h-40 object-cover flex-shrink-0">
                    <a href="{{ asset('storage/' . $img) }}" target="_blank" class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 text-white text-sm font-semibold opacity-0 group-hover:opacity-100 transition-opacity duration-200">
                        <svg class="w-6 h-6 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                        </svg>
                        Lihat Gambar
                    </a>
                </div>
            @empty
                <div class="col-span-full w-full h-32 bg-gray-200 rounded-md flex items-center justify-center text-gray-400">
                    <svg class="w-16 h-16" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd" d="M4 3a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V5a2 2 0 00-2-2H4zm12 12H4l4-4 3 3 5-5V15z" clip-rule="evenodd"></path>
                    </svg>
                    <p class="ml-2 text-sm">Tidak ada bukti survei terunggah.</p>
                </div>
            @endforelse
        </div>
    </div>

    {{-- Tombol Aksi --}}
    <div class="mt-8 flex justify-end space-x-3">
        <form action="{{ route('admin.verifikasi.tolak', $hasil->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Pastikan method PUT jika mengubah status --}}
            <input type="hidden" name="alasan_penolakan" value="Tidak memenuhi syarat"> {{-- Anda mungkin ingin membuat ini dinamis --}}
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 border border-red-600 rounded-lg text-red-600 bg-red-50 hover:bg-red-100 font-medium transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-red-500 focus:ring-opacity-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
                Tolak
            </button>
        </form>

        <form action="{{ route('admin.verifikasi.setujui', $hasil->id) }}" method="POST">
            @csrf
            @method('PUT') {{-- Pastikan method PUT jika mengubah status --}}
            <button type="submit"
                    class="inline-flex items-center px-5 py-2 border border-blue-600 rounded-lg text-white bg-blue-600 hover:bg-blue-700 font-medium transition duration-150 ease-in-out focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-opacity-50">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
                Setujui
            </button>
        </form>
    </div>
</div>
@endsection