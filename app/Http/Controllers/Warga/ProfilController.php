<?php

namespace App\Http\Controllers\Warga;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class ProfilController extends Controller
{
    public function showProfile(): View
    {
        // Ambil user yang login
        $user = Auth::user();
        $warga = \App\Models\Warga::where('id_user', $user->id)->first();

        // Kirim kedua variabel ke view
        return view('warga.profil.index', [
            'user' => $user,
            'warga' => $warga
        ]);
    }
}
