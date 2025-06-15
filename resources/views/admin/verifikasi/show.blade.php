@extends('admin.layouts.layout')

@section('title', 'Detail Verifikasi')

@section('content')
<div class="max-w-3xl mx-auto p-6 bg-white shadow rounded">
    <a href="{{ route('admin.verifikasi.index') }}" class="text-blue-600 text-sm mb-4 inline-block">&larr; Kembali</a>

    <h2 class="text-xl font-semibold mb-4">Verifikasi Hasil Lapangan</h2>

    <p><strong>Tanggal:</strong> {{ $hasil->tgl_survey->translatedFormat('d F Y') }}</p>
    <p><strong>Status Kepemilikan:</strong> {{ $hasil->status_kepemilikan }}</p>
    <p><strong>Kondisi Ekonomi:</strong> {{ $hasil->verifikasi_ekonomi }}</p>

    <p class="mt-3 font-semibold">Dokumen:</p>
    <ul class="list-disc list-inside">
        @foreach ($hasil->detail_verifikasi_dokumen as $dok)
            <li>{{ $dok }}</li>
        @endforeach
    </ul>

    <p class="mt-3"><strong>Catatan:</strong> {{ $hasil->catatan_survei }}</p>

    <p class="mt-3 font-semibold">Bukti Survei:</p>
    <div class="grid grid-cols-2 gap-4">
        @foreach ($hasil->bukti_survei as $img)
            <a href="{{ asset('storage/' . $img) }}" target="_blank" class="block border rounded p-2 hover:shadow">
                <img src="{{ asset('storage/' . $img) }}" alt="Bukti" class="w-full h-40 object-cover rounded" />
            </a>
        @endforeach
    </div>

    <p class="mt-4"><strong>Rekomendasi:</strong> {{ $hasil->status_rekomendasi }}</p>

    <div class="mt-6 flex gap-4">
        <form action="{{ route('admin.verifikasi.tolak', $hasil->id) }}" method="POST">
            @csrf
            <input type="hidden" name="alasan_penolakan" value="Tidak memenuhi syarat">
            <button type="submit" class="bg-red-600 hover:bg-red-700 text-white px-4 py-2 rounded">
                Tolak
            </button>
        </form>

        <form action="{{ route('admin.verifikasi.setujui', $hasil->id) }}" method="POST">
            @csrf
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded">
                Setujui
            </button>
        </form>
    </div>
</div>
@endsection
