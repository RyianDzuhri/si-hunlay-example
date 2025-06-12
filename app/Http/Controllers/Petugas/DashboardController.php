<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function showDashboard (): View
    {
        $user = Auth::user();

        // Data dummy untuk ringkasan tugas
        $ringkasanTugas = (object) [
            'total' => 10,
            'berlangsung' => 3,
            'selesai' => 5,
        ];

        // Data dummy untuk tugas terbaru
        $tugasTerbaru = [
            (object)['nama_warga' => 'Gusti Krisna Pranata', 'kode_pengajuan' => 'RTLH-2025-0597', 'lokasi' => 'Jl. Kosgoro No.10 Kel Baruga', 'status' => 'Selesai', 'tanggal' => '8 Juni 2025'],
            (object)['nama_warga' => 'Gusti Krisna Pranata', 'kode_pengajuan' => 'RTLH-2025-0597', 'lokasi' => 'Jl. Kosgoro No.10 Kel Baruga', 'status' => 'Selesai', 'tanggal' => '8 Juni 2025'],
            (object)['nama_warga' => 'Gusti Krisna Pranata', 'kode_pengajuan' => 'RTLH-2025-0597', 'lokasi' => 'Jl. Kosgoro No.10 Kel Baruga', 'status' => 'Selesai', 'tanggal' => '8 Juni 2025'],
            (object)['nama_warga' => 'Gusti Krisna Pranata', 'kode_pengajuan' => 'RTLH-2025-0597', 'lokasi' => 'Jl. Kosgoro No.10 Kel Baruga', 'status' => 'Selesai', 'tanggal' => '8 Juni 2025'],
            (object)['nama_warga' => 'Gusti Krisna Pranata', 'kode_pengajuan' => 'RTLH-2025-0597', 'lokasi' => 'Jl. Kosgoro No.10 Kel Baruga', 'status' => 'Selesai', 'tanggal' => '8 Juni 2025'],
        ];

        return view('petugas.dashboard.dashboard', compact('user', 'ringkasanTugas', 'tugasTerbaru'));
    }
}
