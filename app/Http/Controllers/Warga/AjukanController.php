<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AjukanController extends Controller
{
    public function formPengajuan(): View
    {
        return view('warga.ajukan.index');
    }
}
