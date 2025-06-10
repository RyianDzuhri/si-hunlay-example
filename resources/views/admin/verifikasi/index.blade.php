@extends('admin.layouts.master')

@section('title', 'Hasil Verifikasi')

@section('content')
    <h1>Hasil Verifikasi Pengajuan</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%; border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID Verifikasi</th>
                <th>Nama</th>
                <th>Status</th>
                <th>Tanggal</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($verifikasi as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['status'] }}</td>
                    <td>{{ $item['tanggal'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
