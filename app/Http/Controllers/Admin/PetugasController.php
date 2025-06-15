<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Petugas;
use App\Models\Kecamatan;

class PetugasController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'petugas')->with(['petugas.kecamatan']);

        // Search filter by nama or nip
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('petugas', fn($q2) => $q2->where('nip', 'like', "%{$search}%"));
            });
        }

        // Filter berdasarkan wilayah/kecamatan
        if ($request->filled('wilayah')) {
            $query->whereHas('petugas.kecamatan', function ($q) use ($request) {
                $q->where('nama_kecamatan', $request->wilayah);
            });
        }

        $petugas = $query->paginate(10);
        $wilayahList = Kecamatan::pluck('nama_kecamatan', 'nama_kecamatan');

        return view('admin.akun.petugas.index', compact('petugas', 'wilayahList'));
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Petugas berhasil dihapus.');
    }
}
