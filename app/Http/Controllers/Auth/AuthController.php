<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthVerifyRequest;
use App\Models\User;
use App\Models\Warga;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class AuthController extends Controller
{
     public function showLoginForm (): View
    {
        return view('auth.login');
    }

    public function showRegisterForm (): View
    {
        return view('auth.register');
    }

    public function verify(UserAuthVerifyRequest $request): RedirectResponse
    {
        $data = $request->validated();
        
        if (Auth::guard('warga')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'warga'])) {
            $request->session()->regenerate();
            return redirect()->intended('/warga/dashboard');
        } else if (Auth::guard('petugas')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'petugas'])) {
            $request->session()->regenerate();
            return redirect()->intended('/petugas/dashboard');
        } else if (Auth::guard('admin_dinas')->attempt(['email' => $data['email'], 'password' => $data['password'], 'role' => 'admin_dinas'])) {
            $request->session()->regenerate();
            return redirect()->intended('/admin/dashboard');
        } else {
            return redirect(route('login'))->with('msg', 'email atau password salah');
        }

        // dd($request->validated());
    }

    public function logout(Request $request): RedirectResponse
    {
        if (Auth::guard('admin_dinas')->check()) {
            Auth::guard('admin_dinas')->logout();
        } else if (Auth::guard('warga')->check()) {
            Auth::guard('warga')->logout();
        } else if (Auth::guard('petugas')->check()) {
            Auth::guard('petugas')->logout();
        }

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect(route('login'));
    }

    public function createAccount(Request $request)
    {
        // 1. Validasi input dari pengguna
        $request->validate([
            'nik' => 'required|numeric|digits:16|unique:warga,nik',
            'no_kk' => 'required|numeric|digits:16|unique:warga,no_kk',
            'nama' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'no_hp' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
            'syarat' => 'accepted',
        ]);

        // 2. Menggunakan DB Transaction untuk memastikan data konsisten
        // Jika salah satu gagal, semua akan dibatalkan.
        DB::beginTransaction();
        try {
            $user = User::create([
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'nama' => $request->nama,
                'role' => 'warga',
            ]);

            $warga = Warga::create([
                'nik' => $request->nik,
                'no_kk' => $request->no_kk,
                'no_hp' => $request->no_hp,
                'id_user' => $user->id,
            ]);

            DB::commit();

            // 6. Login-kan pengguna secara otomatis setelah registrasi
            Auth::guard('warga')->login($user);

            // 7. Alihkan ke halaman dashboard warga
            return redirect()->route('warga.dashboard')->with('success', 'Registrasi berhasil! Selamat datang.');

        } catch (\Exception $e) {
            DB::rollBack();
            dd($e->getMessage()); // untuk debugging
        }
    }

}
