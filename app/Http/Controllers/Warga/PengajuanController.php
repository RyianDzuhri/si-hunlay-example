<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class PengajuanController extends Controller
{
    public function showPengajuan (): View
    {   
        $user = Auth::user();
        return view('warga.pengajuan-saya.index', compact('user'));
    }
}
