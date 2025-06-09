<?php

namespace App\Http\Controllers\Masyarakat;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgresController extends Controller
{
    public function showProgres(): View
    {
        return view('masyarakat.progres');
    }
}
