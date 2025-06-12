<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PengajuanExport implements FromCollection, WithHeadings
{
    protected $pengajuan;

    public function __construct(Collection $pengajuan)
    {
        $this->pengajuan = $pengajuan;
    }

    public function collection()
    {
        return $this->pengajuan;
    }

    public function headings(): array
    {
        return ['Nama', 'NIK', 'Alamat', 'Tanggal Pengajuan', 'Status'];
    }
}
