<?php

namespace App\Http\Controllers\Petugas;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TugasController extends Controller
{
    public function showTugas(): View
    {
        return view('petugas.daftar-tugas.tugas');
    }
}
