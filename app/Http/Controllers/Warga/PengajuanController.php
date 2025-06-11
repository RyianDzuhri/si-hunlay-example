<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function showPengajuanForm (): View
    {
        return view('warga.pengajuan.index');
    }
}
