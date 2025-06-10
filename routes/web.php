<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Masyarakat\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\Auth\LoginController as AdminLoginController;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\ProgresController;

Route::get('/', function () {
    return view('landing.welcome');
});

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');



//Masyarakat
Route::prefix('warga')->middleware(['auth:warga'])->group(function () {
   Route::get('/dashboard', [WargaDashboardController::class, 'showDashboard'])->name('warga.dashboard');
   Route::get('/progres', [ProgresController::class, 'showProgres'])->name('warga.progres');
});



//Admin
Route::prefix('admin')->middleware(['auth:admin_dinas'])->group(function () {
    // Tampilkan halaman login admin
    Route::get('/login', [AdminLoginController::class, 'showLoginForm'])->name('admin.login');

    // Proses form login admin
    Route::post('/login', [AdminLoginController::class, 'login'])->name('admin.login.submit');

    // Tampilkan halaman dashboard admin
    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');

    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');

    // Route pengajuan
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('admin.pengajuan');

    // Route penugasan
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('admin.penugasan');

    // Route verifikasi
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('admin.verifikasi');

    // Route verifikasi
    Route::get('/bantuan', [VerifikasiController::class, 'index'])->name('admin.bantuan');

    // Route verifikasi
    Route::get('/profile', [VerifikasiController::class, 'index'])->name('admin.profile');

    // Route manajemen user
    Route::get('/akun/pengguna', [UserController::class, 'index'])->name('admin.akun.pengguna');

    // Route manajemen user
    Route::get('/akun/petugas', [UserController::class, 'index'])->name('admin.akun.petugas');
     

});

//Petugas
Route::prefix('petugas')->middleware(['auth:petugas'])->group(function () {
   Route::get('/dashboard', [PetugasDashboardController::class, 'showDashboard'])->name('petugas.dashboard');
});