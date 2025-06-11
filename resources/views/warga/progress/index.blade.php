@extends('warga.layout.master')
@section('title', 'Warga - Progres Pengajuan')

@section('content')
<div class="container mx-auto p-4 md:p-6">
    <div class="flex items-center gap-3 mb-8">
        <img src="{{ asset('images/Time.png') }}" alt="Icon" class="w-8 h-8">
        <h2 class="text-2xl md:text-3xl font-bold">Timeline Status Pengajuan</h2>
    </div>

    {{-- Tampilkan pesan jika belum ada pengajuan sama sekali --}}
    @if (!$pengajuan)
        <div class="bg-gray-100 p-8 rounded-lg text-center">
            <p class="text-gray-600">Anda belum memiliki pengajuan. Silakan ajukan bantuan terlebih dahulu untuk melihat progres di halaman ini.</p>
        </div>
    @else
        {{-- Tampilkan pesan khusus jika pengajuan DITOLAK --}}
        @if ($pengajuan->status == 'DITOLAK')
            @php
                $lastHistory = $pengajuan->histori()->latest('waktu_perubahan')->first();
            @endphp
            <div class="bg-red-50 border-l-4 border-red-500 text-red-800 p-6 rounded-lg shadow-md">
                <h3 class="font-bold text-xl">Pengajuan Anda Ditolak</h3>
                @if ($lastHistory && $lastHistory->catatan)
                    <p class="mt-2"><strong>Alasan:</strong> {{ $lastHistory->catatan }}</p>
                @endif
                 <p class="text-xs mt-4">Silakan hubungi dinas terkait untuk informasi lebih lanjut.</p>
            </div>
        @else
            {{-- Tampilkan timeline progres jika statusnya normal --}}
            <div class="space-y-6 border-l-2 border-gray-200 ml-4 pl-8">
                @foreach ($statusMapping as $status => $details)
                    @php
                        if ($currentStep > $details['step']) {
                            $state = 'completed';
                        } elseif ($currentStep == $details['step']) {
                            $state = 'current';
                        } else {
                            $state = 'upcoming';
                        }
                    @endphp
                    
                    <div class="relative">
                        <div class="absolute -left-[3.2rem] top-1 w-8 h-8 rounded-full flex items-center justify-center
                            @if($state == 'completed') bg-blue-600 text-white
                            @elseif($state == 'current') bg-indigo-600 text-white ring-8 ring-indigo-100
                            @else bg-gray-300 text-gray-600 @endif">
                            
                            @if ($state == 'completed')
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path></svg>
                            @else
                                {{ $details['step'] }}
                            @endif
                        </div>

                        <div class="p-4 rounded-md @if($state != 'upcoming') bg-white shadow-sm border border-gray-200 @endif">
                            <h3 class="text-lg font-semibold {{ $state != 'upcoming' ? 'text-gray-800' : 'text-gray-400' }}">
                                {{ $details['title'] }}
                            </h3>
                            @if ($state != 'upcoming')
                                <p class="text-sm text-gray-700 mt-1">{{ $details['desc'] }}</p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection