<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function showDashboard(): View
    {
        $status = 1;
        return view('warga.dashboard.dashboard', compact('status'));
    }
}
