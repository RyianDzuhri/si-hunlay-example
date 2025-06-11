<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LayoutController extends Controller
{
    public function toLayout(): View
    {
        $user = Auth::user();
        return view('warga.layout.master');
    }
}
