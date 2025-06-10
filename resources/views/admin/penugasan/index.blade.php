@extends('admin.layouts.master')

@section('title', 'Daftar Penugasan')

@section('content')
    <h1>Daftar Penugasan</h1>

    <table border="1" cellpadding="10" cellspacing="0" style="width:100%;border-collapse: collapse;">
        <thead>
            <tr>
                <th>ID Penugasan</th>
                <th>Nama Petugas</th>
                <th>Tugas</th>
                <th>Tanggal</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($penugasan as $item)
                <tr>
                    <td>{{ $item['id'] }}</td>
                    <td>{{ $item['nama_petugas'] }}</td>
                    <td>{{ $item['tugas'] }}</td>
                    <td>{{ $item['tanggal'] }}</td>
                    <td>{{ $item['status'] }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
