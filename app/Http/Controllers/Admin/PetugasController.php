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

        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                  ->orWhereHas('petugas', fn($q2) => $q2->where('nip', 'like', "%{$search}%"));
            });
        }

        if ($request->filled('wilayah')) {
            $query->whereHas('petugas.kecamatan', function ($q) use ($request) {
                $q->where('nama_kecamatan', $request->wilayah);
            });
        }

        $petugas = $query->paginate(10);
        $wilayahList = Kecamatan::pluck('nama_kecamatan', 'nama_kecamatan');

        return view('admin.akun.petugas.index', compact('petugas', 'wilayahList'));
    }

    public function create()
    {
        $kecamatanList = Kecamatan::all();
        return view('admin.akun.petugas.create', compact('kecamatanList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6',
            'nip' => 'required|unique:petugas,nip',
            'kecamatan_id' => 'required|exists:kecamatan,id',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => 'petugas',
        ]);

        Petugas::create([
            'nip' => $request->nip,
            'id_user' => $user->id,
            'kecamatan_id' => $request->kecamatan_id,
        ]);

        return redirect()->route('admin.akun.petugas.index')->with('success', 'Akun petugas berhasil ditambahkan.');
    }

    public function destroy($id)
    {
        User::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Petugas berhasil dihapus.');
    }
}
