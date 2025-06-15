<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController as AdminDashboardController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Petugas\DashboardController as PetugasDashboardController;
use App\Http\Controllers\Warga\AjukanController;
use App\Http\Controllers\Warga\DashboardController as WargaDashboardController;
use App\Http\Controllers\Warga\PengajuanController;
use App\Http\Controllers\Warga\ProfilController;
use App\Http\Controllers\Warga\ProgressController;
use App\Http\Controllers\Admin\AdminPengajuanController as AdminPengajuanController;
use App\Http\Controllers\Petugas\TugasController;
use App\Http\Controllers\Petugas\VerifikasiTugasController;

Route::get('/', function () {
    return view('landing.welcome');
});

//Auth
Route::get('/login', [AuthController::class, 'showLoginForm'])
    ->name('login')
    ->middleware('guest');
Route::post('/login', [AuthController::class, 'verify'])->name('auth.verify');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register');
Route::post('/register', [AuthController::class, 'createAccount'])->name('register.akun');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');



//Warga
Route::prefix('warga')->middleware(['auth:warga'])->group(function () {
   Route::get('/dashboard', [WargaDashboardController::class, 'showDashboard'])->name('warga.dashboard');
   Route::get('/progress', [ProgressController::class, 'showProgress'])->name('warga.progress');
   Route::get('/ajukan', [AjukanController::class, 'formPengajuan'])->name('warga.ajukan');
   Route::post('/ajukan', [AjukanController::class, 'store'])->name('warga.pengajuan.store');
   Route::get('/get-kelurahan-by-kecamatan/{kecamatan_id}', [AjukanController::class, 'getKelurahan'])->name('get.kelurahan');
   Route::get('/pengajuan-saya', [PengajuanController::class, 'showPengajuan'])->name('warga.pengajuan');
   Route::get('/profil', [ProfilController::class, 'showProfile'])->name('warga.profil');
});



Route::prefix('admin')->middleware(['auth:admin_dinas'])->group(function () {
    // Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'showDashboard'])->name('admin.dashboard');

    // Pengajuan Bantuan
    Route::get('/pengajuan', [AdminPengajuanController::class, 'index'])->name('admin.pengajuan');
    Route::get('/pengajuan/export', [AdminPengajuanController::class, 'export'])->name('admin.export');
    Route::get('/admin/pengajuan/{id}/verifikasi', [AdminPengajuanController::class, 'verifikasi'])->name('admin.pengajuan.verifikasi');
    Route::get('/admin/pengajuan', [AdminPengajuanController::class, 'index'])->name('admin.pengajuan.index');

    // Penugasan
    Route::get('/penugasan', [PenugasanController::class, 'index'])->name('admin.penugasan');

    // Hasil Verifikasi
    Route::get('/verifikasi', [VerifikasiController::class, 'index'])->name('admin.verifikasi');

    // Bantuan
    Route::get('/bantuan', [VerifikasiController::class, 'index'])->name('admin.bantuan');

    // Profile
    Route::get('/profile', [VerifikasiController::class, 'index'])->name('admin.profile');

    // Manajemen Akun Pengguna dan Petugas
    Route::get('/akun/pengguna', [UserController::class, 'index'])->name('admin.akun.pengguna');
    Route::get('/akun/petugas', [UserController::class, 'index'])->name('admin.akun.petugas');
});

//Petugas
Route::prefix('petugas')->middleware(['auth:petugas'])->group(function () {
   Route::get('/dashboard', [PetugasDashboardController::class, 'showDashboard'])->name('petugas.dashboard');
   Route::get('/daftar-tugas', [TugasController::class, 'showTugas'])->name('petugas.tugas');
   Route::get('/verifikasi-tugas/{id}', [VerifikasiTugasController::class, 'showVerifikasiTugasform'])->name('petugas.verifikasi');
});
