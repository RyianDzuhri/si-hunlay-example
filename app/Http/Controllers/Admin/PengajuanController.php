<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\PengajuanExport;
use Illuminate\Pagination\LengthAwarePaginator;

class PengajuanController extends Controller
{
    protected function dummyData(): Collection
    {
        return collect([
            [
                'id' => 1,
                'nama' => 'Surya Wijaya',
                'nik' => '1234567890123456',
                'alamat' => 'Jl. Melati No.1',
                'tanggal_pengajuan' => '2025-06-01',
                'status' => 'Menunggu',
                'kode_pengajuan' => 'PGJ001'
            ],
            [
                'id' => 2,
                'nama' => 'Ani Lestari',
                'nik' => '2345678901234567',
                'alamat' => 'Jl. Anggrek No.5',
                'tanggal_pengajuan' => '2025-06-02',
                'status' => 'Diverifikasi',
                'kode_pengajuan' => 'PGJ002'
            ],
            [
                'id' => 3,
                'nama' => 'Budi Santoso',
                'nik' => '3456789012345678',
                'alamat' => 'Jl. Kenanga No.10',
                'tanggal_pengajuan' => '2025-06-03',
                'status' => 'Ditolak',
                'kode_pengajuan' => 'PGJ003'
            ],
        ]);
    }

    public function index(Request $request)
    {
        $pengajuan = $this->dummyData();

        // Pencarian berdasarkan nama atau NIK
        if ($request->filled('q')) {
            $keyword = strtolower($request->input('q'));
            $pengajuan = $pengajuan->filter(function ($item) use ($keyword) {
                return str_contains(strtolower($item['nama']), $keyword) ||
                       str_contains(strtolower($item['nik']), $keyword);
            });
        }

        // Filter berdasarkan status
        if ($request->filled('status') && $request->input('status') != '') {
            $pengajuan = $pengajuan->where('status', $request->input('status'));
        }

        // Urutkan berdasarkan tanggal_pengajuan (descending)
        $pengajuan = $pengajuan->sortByDesc('tanggal_pengajuan')->values();

        // Jika ada permintaan export
        if ($request->has('export')) {
            $exportData = $pengajuan->map(function ($item) {
                return [
                    'Nama' => $item['nama'],
                    'NIK' => $item['nik'],
                    'Alamat' => $item['alamat'],
                    'Tanggal Pengajuan' => $item['tanggal_pengajuan'],
                    'Status' => $item['status'],
                ];
            });

            return Excel::download(new PengajuanExport($exportData), 'pengajuan.xlsx');
        }

        // Manual pagination
        $perPage = 10;
        $currentPage = $request->input('page', 1);
        $paged = $pengajuan->slice(($currentPage - 1) * $perPage, $perPage)->values();

        $paginated = new LengthAwarePaginator(
            $paged,
            $pengajuan->count(),
            $perPage,
            $currentPage,
            ['path' => $request->url(), 'query' => $request->query()]
        );

        return view('admin.pengajuan.index', [
            'pengajuan' => $paginated
        ]);
    }

    public function export(Request $request)
{
    $pengajuan = $this->dummyData();

    // Filter jika diperlukan
    if ($request->filled('search')) {
        $keyword = strtolower($request->input('search'));
        $pengajuan = $pengajuan->filter(function ($item) use ($keyword) {
            return str_contains(strtolower($item['nama']), $keyword) ||
                   str_contains(strtolower($item['nik']), $keyword);
        });
    }

    if ($request->filled('status') && $request->input('status') != 'Semua') {
        $pengajuan = $pengajuan->where('status', $request->input('status'));
    }

    $exportData = $pengajuan->map(function ($item) {
        return [
            'Nama' => $item['nama'],
            'NIK' => $item['nik'],
            'Alamat' => $item['alamat'],
            'Tanggal Pengajuan' => $item['tanggal_pengajuan'],
            'Status' => $item['status'],
        ];
    });

    return \Maatwebsite\Excel\Facades\Excel::download(new \App\Exports\PengajuanExport($exportData), 'pengajuan.xlsx');
}

}
