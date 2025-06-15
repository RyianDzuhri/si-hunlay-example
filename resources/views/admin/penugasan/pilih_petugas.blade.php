@extends('layouts.admin')

@section('content')
    <h2>Penugasan Petugas</h2>

    <p><strong>Pengajuan:</strong> {{ $pengajuan->kode_pengajuan }} - {{ $pengajuan->warga->user->name }}</p>
    <p><strong>Wilayah:</strong> {{ $pengajuan->kelurahan->kecamatan->nama_kecamatan }}</p>

    <form action="{{ route('admin.penugasan.tugaskan', $pengajuan->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="petugas_nip">Pilih Petugas:</label>
        <select name="petugas_nip" id="petugas_nip" class="form-control" required>
            <option value="" disabled selected>-- Pilih Petugas --</option>
            @forelse($petugasList as $petugas)
                <option value="{{ $petugas->nip }}">
                    {{ $petugas->user->name }} ({{ $petugas->wilayahTugas }})
                </option>
            @empty
                <option value="">Tidak ada petugas di wilayah ini</option>
            @endforelse
        </select>

        <button type="submit" class="btn btn-primary mt-2">Tugaskan</button>
    </form>
@endsection
