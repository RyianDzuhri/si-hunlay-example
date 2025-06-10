<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        // Contoh data user
        $users = [
            ['id' => 1, 'name' => 'Budi Santoso', 'email' => 'budi@example.com', 'role' => 'User'],
            ['id' => 2, 'name' => 'Sari Dewi', 'email' => 'sari@example.com', 'role' => 'Admin'],
        ];

        return view('admin.akun.pengguna.index', compact('users'));
    }
}
