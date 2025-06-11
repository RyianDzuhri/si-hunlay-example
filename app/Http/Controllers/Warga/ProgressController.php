<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProgressController extends Controller
{
    public function showProgress (): View
    {
        $status = 1;
        return view('warga.progress.index', compact('status'));
    }
}
