<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class PenugasanController extends Controller
{
    public function index()
    {
        // Contoh data dummy, sesuaikan dengan data sebenarnya nanti
        $penugasan = [
            ['id' => 'P-001', 'nama_petugas' => 'Budi Santoso', 'tugas' => 'Survey Lokasi', 'tanggal' => '5 Juni 2025', 'status' => 'Berjalan'],
            ['id' => 'P-002', 'nama_petugas' => 'Ani Wulandari', 'tugas' => 'Verifikasi Dokumen', 'tanggal' => '6 Juni 2025', 'status' => 'Selesai'],
        ];

        return view('admin.penugasan.index', compact('penugasan'));
    }
}
