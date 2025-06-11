@extends('warga.layout.master')
@section('title', 'Warga - Progres Pengajuan')

@section('content')
<div class="container mx-auto p-4">
    <h2 class="text-2xl font-bold mb-6 flex items-center gap-2">
        <img src="{{ asset('images/Time.png') }}" alt="Icon" class="w-5 h-5">
        Timeline Status Pengajuan
    </h2>

    @php
        $statuses = [
            ['title' => 'Pengajuan Diterima', 'desc' => 'Pengajuan bantuan rumah tidak layak huni telah diterima dan sedang dalam proses verifikasi awal'],
            ['title' => 'Verifikasi Dokumen', 'desc' => 'Dokumen persyaratan telah diverifikasi dan dinyatakan lengkap. Pengajuan akan dilanjutkan ke tahap survei lapangan'],
            ['title' => 'Jadwal Survei', 'desc' => 'Tim survei akan mengunjungi lokasi rumah pada tanggal yang telah ditentukan. Mohon kehadiran Anda di lokasi.'],
            ['title' => 'Hasil Survei', 'desc' => 'Hasil survei akan diproses dan dianalisis oleh tim teknis untuk menentukan kelayakan bantuan'],
            ['title' => 'Penetapan Keputusan', 'desc' => 'Hasil survei akan diproses dan dianalisis oleh tim teknis untuk menentukan kelayakan bantuan'],
            ['title' => 'Pelaksanaan Bantuan', 'desc' => 'Jika disetujui, bantuan perbaikan rumah akan dilaksanakan sesuai dengan jadwal yang ditentukan'],
        ];

        $colors = [
            'completed' => 'bg-blue-100 border-blue-400',
            'current' => 'bg-indigo-100 border-indigo-400',
            'upcoming' => 'bg-gray-100 border-gray-300',
        ];
    @endphp

    <div class="space-y-6">
        @foreach ($statuses as $i => $item)
            @php
                if ($i < $status) {
                    $state = 'completed';
                } elseif ($i == $status) {
                    $state = 'current';
                } else {
                    $state = 'upcoming';
                }
            @endphp

            <div class="border-l-4 p-4 {{ $colors[$state] }} rounded-md shadow-sm">
                <h3 class="text-lg font-semibold">{{ $item['title'] }}</h3>
                <p class="text-sm text-gray-700 mt-1">{{ $item['desc'] }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection
