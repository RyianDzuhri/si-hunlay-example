<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserAuthVerifyRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

}
