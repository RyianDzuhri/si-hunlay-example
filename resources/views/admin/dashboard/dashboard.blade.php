@extends('admin.layouts.master')

@section('title', 'Dashboard Admin - SI-Hunlay')

@section('header-title', 'Selamat Datang, Admin')

@section('content')
    <p class="subtitle">Ringkasan data dan aktivitas SI-Hunlay Kota Kendari</p>

    <section class="stats" style="display:grid; grid-template-columns: repeat(4, 1fr); gap:20px; margin-bottom:20px;">
        @php
            $stats = [
                ['label' => 'Total Pengajuan Masuk', 'jumlah' => 100],
                ['label' => 'Pengajuan Diverifikasi', 'jumlah' => 100],
                ['label' => 'Disetujui', 'jumlah' => 100],
                ['label' => 'Ditolak', 'jumlah' => 100],
            ];
        @endphp
        @foreach ($stats as $stat)
            <div class="stat-card" style="background:#fff; padding:15px; border-radius:8px; text-align:center; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
                <h3 style="font-size:14px; color:#666; margin-bottom:5px;">{{ $stat['label'] }}</h3>
                <p style="font-size:20px; font-weight:600; color:#1E60E1;">
                    {{ $stat['jumlah'] }} <span style="color:green;">↑ 50% dari bulan lalu</span>
                </p>
            </div>
        @endforeach
    </section>

    <section class="charts" style="display:grid; grid-template-columns: 2fr 1fr; gap:20px; margin-bottom:20px;">
        <div class="chart-card" style="background:#fff; padding:15px; border-radius:8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h3>Statistik Pengajuan per Kecamatan</h3>
            <div style="height: 200px; background: #e0e0e0;">[Bar Chart]</div>
        </div>
        <div class="chart-card" style="background:#fff; padding:15px; border-radius:8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
            <h3>Status Pengajuan</h3>
            <div style="height: 200px; background: #e0e0e0;">[Pie Chart]</div>
        </div>
    </section>

    <section class="table" style="background:#fff; padding:15px; border-radius:8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1);">
        <h3>Pengajuan Terbaru</h3>
        <table style="width: 100%; border-collapse: collapse;">
            <thead>
                <tr>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">ID Pengajuan</th>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">Nama</th>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">Kecamatan</th>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">Tanggal</th>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">Status</th>
                    <th style="padding:10px; text-align:left; border-bottom:1px solid #e0e0e0; background:#f5f7fa; font-weight:600;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $pengajuanTerbaru = [
                        ['id' => 'RTLH-2025-01-041', 'nama' => 'Gusti Krisna Pranata', 'kecamatan' => 'Baruga', 'tanggal' => '3 Juni 2025', 'status' => 'Verifikasi'],
                        // Tambahkan data nyata di sini
                    ];
                @endphp
                @foreach ($pengajuanTerbaru as $pengajuan)
                    <tr>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">{{ $pengajuan['id'] }}</td>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">{{ $pengajuan['nama'] }}</td>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">{{ $pengajuan['kecamatan'] }}</td>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">{{ $pengajuan['tanggal'] }}</td>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">{{ $pengajuan['status'] }}</td>
                        <td style="padding:10px; border-bottom:1px solid #e0e0e0;">
                            <a href="#">Detail</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>
@endsection
