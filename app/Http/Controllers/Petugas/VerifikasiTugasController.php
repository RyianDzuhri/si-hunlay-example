<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class VerifikasiTugasController extends Controller
{
    public function showVerifikasiTugasform(): View
    {
        return view('petugas.verifikasi.index');
    }
}
