<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.welcome');
});

<<<<<<< HEAD
Route::get('/login', [LoginController::class,'showLoginForm'])->name('auth.login');
Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('auth.register');

=======
// Admin
Route::prefix('admin')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
});
>>>>>>> 55d2fec45b36bc20dfd11d43dcfe2b8b509488ce
