<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Masyarakat\DashboardController;
use App\Http\Controllers\Masyarakat\ProgresController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;


Route::get('/', function () {
    return view('landing.welcome');
});

//Auth
Route::prefix('auth')->group(function () {
    Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
    Route::get('register', [RegisterController::class, 'showRegisterForm'])->name('auth.register');
});

//Masyarakat
Route::prefix('masyarakat')->group(function () {
   Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('masyarakat.dashboard');
   Route::get('/progres', [ProgresController::class, 'showProgres'])->name('masyarakat.progres');
});
Route::get('/login', [LoginController::class,'showLoginForm'])->name('auth.login');
Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('auth.register');

Route::prefix('admin')->group(function () {
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');
    Route::get('/password/reset', [AdminLoginController::class, 'showResetForm'])->name('password.request');
    Route::get('/dashboard', function () {
        return view('admin.dashboard'); // Arahkan ke view dashboard
    })->name('admin.dashboard')->middleware('auth:admin'); // Tambahkan middleware autentikasi
});