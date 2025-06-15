<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'warga')->with('warga');

        // Ambil keyword pencarian dari input form
        if ($request->has('search') && !empty($request->search)) {
            $keyword = $request->search;

            // Cari berdasarkan nama (dari users.nama) atau nik (dari relasi warga.nik)
            $query->where(function ($q) use ($keyword) {
                $q->where('nama', 'like', '%' . $keyword . '%')
                  ->orWhereHas('warga', function ($w) use ($keyword) {
                      $w->where('nik', 'like', '%' . $keyword . '%');
                  });
            });
        }

        $users = $query->paginate(10);

        return view('admin.akun.pengguna.index', compact('users'));
    }
}