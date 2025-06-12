<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function showPengajuan(): View
    {
        $user = Auth::user();
        $warga = $user->warga;
        $pengajuan = (object) [
            'tanggal_pengajuan' => '1 Juni 2025',
            'status_kepemilikan' => 'Milik Sendiri',
            'jumlah_penghuni' => 4,
            'luas_rumah' => '50 M²',
            'jenis_kerusakan' => [
                'Atap: Rangka lapuk',
                'Lantai: Tanah'
            ],
            'dokumen' => [
                (object)['nama' => 'Fotokopi KTP', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=KTP'],
                (object)['nama' => 'Fotokopi Kartu Keluarga (KK)', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=KK'],
                (object)['nama' => 'Surat Keterangan Tidak Mampu (SKTM)', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=SKTM'],
                (object)['nama' => 'Bukti/keterangan kepemilikan rumah', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=Kepemilikan'],
                (object)['nama' => 'Foto rumah tampak depan', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=Depan'],
                (object)['nama' => 'Foto rumah tampak belakang', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=Belakang'],
                (object)['nama' => 'Foto bagian rumah yang rusak 1', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=Rusak%201'],
                (object)['nama' => 'Foto bagian rumah yang rusak 2', 'url' => 'https://placehold.co/150x100/eeeeee/333333?text=Rusak%202'],
            ]
        ];

        return view('warga.pengajuan-saya.index', compact('user', 'pengajuan', 'warga'));
    }
}