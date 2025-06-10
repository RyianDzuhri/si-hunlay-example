@extends('admin.layouts.master')

@section('title', 'Daftar Pengajuan Bantuan')

@section('content')
    <h1>Daftar Pengajuan Bantuan</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID Pengajuan</th>
                <th>Nama</th>
                <th>Kecamatan</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($pengajuan as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['nama'] }}</td>
                    <td>{{ $item['kecamatan'] }}</td>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
