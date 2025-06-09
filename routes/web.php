<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.welcome');
});

Route::get('/login', [LoginController::class,'showLoginForm'])->name('auth.login');
Route::get('/register', [RegisterController::class,'showRegisterForm'])->name('auth.register');

