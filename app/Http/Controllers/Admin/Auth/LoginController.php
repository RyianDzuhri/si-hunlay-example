<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.login');
    }

    public function login(Request $request)
{
    // Validasi input (opsional)
    $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    // Langsung redirect ke dashboard
    return redirect()->route('admin.dashboard');
}


    public function showResetForm()
    {
        return view('admin.auth.password-reset');
    }
}