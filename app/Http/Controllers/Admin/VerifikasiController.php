<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class VerifikasiController extends Controller
{
    public function index()
    {
        // Data dummy contoh verifikasi
        $verifikasi = [
            ['id' => 'V-001', 'nama' => 'Siti Aminah', 'status' => 'Terverifikasi', 'tanggal' => '4 Juni 2025'],
            ['id' => 'V-002', 'nama' => 'Agus Salim', 'status' => 'Menunggu', 'tanggal' => '5 Juni 2025'],
        ];

        return view('admin.verifikasi.index', compact('verifikasi'));
    }
}
