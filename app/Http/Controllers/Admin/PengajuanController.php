<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;

class PengajuanController extends Controller
{
    public function index()
    {
        // Dummy data array
        $data = [
            [
                'id' => 1,
                'nama' => 'Ahmad Surya',
                'kode_pengajuan' => 'PGJ001',
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Merdeka No.1',
                'tanggal_pengajuan' => now()->subDays(3),
                'status' => 'Menunggu',
            ],
            [
                'id' => 2,
                'nama' => 'Siti Aminah',
                'kode_pengajuan' => 'PGJ002',
                'nik' => '1234567890123457',
                'alamat' => 'Jl. Mawar No.10',
                'tanggal_pengajuan' => now()->subDays(5),
                'status' => 'Diverifikasi',
            ],
            [
                'id' => 3,
                'nama' => 'Budi Hartono',
                'kode_pengajuan' => 'PGJ003',
                'nik' => '1234567890123458',
                'alamat' => 'Jl. Melati No.20',
                'tanggal_pengajuan' => now()->subDays(7),
                'status' => 'Ditolak',
            ],
        ];

        // Konversi array menjadi paginated collection
        $currentPage = request()->get('page', 1);
        $perPage = 10;
        $items = collect($data);
        $pengajuan = new LengthAwarePaginator(
            $items->forPage($currentPage, $perPage),
            $items->count(),
            $perPage,
            $currentPage,
            ['path' => request()->url(), 'query' => request()->query()]
        );

        return view('admin.pengajuan.index', compact('pengajuan'));
    }
}
