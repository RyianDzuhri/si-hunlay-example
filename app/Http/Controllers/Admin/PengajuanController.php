<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PengajuanController extends Controller
{
    public function index()
    {
        // Bisa tambah data dari database nanti, sementara kirim array dummy saja
        $pengajuan = [
            ['id' => 'RTLH-2025-01-041', 'nama' => 'Gusti Krisna Pranata', 'kecamatan' => 'Baruga', 'tanggal' => '3 Juni 2025', 'status' => 'Verifikasi'],
            ['id' => 'RTLH-2025-01-042', 'nama' => 'Andi Setiawan', 'kecamatan' => 'Kambu', 'tanggal' => '4 Juni 2025', 'status' => 'Disetujui'],
            ['id' => 'RTLH-2025-01-043', 'nama' => 'Siti Aminah', 'kecamatan' => 'Mandonga', 'tanggal' => '5 Juni 2025', 'status' => 'Ditolak'],
        ];

        return view('admin.pengajuan.index', compact('pengajuan'));
    }
}
