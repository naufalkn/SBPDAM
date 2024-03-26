<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index'); });

// LOGIN
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'prosesLogin']);
// REGISTER
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'prosesDaftar']);
// LOGOUT
Route::get('/logout', [LoginController::class, 'logout']);

Route::middleware(['isAuth'])->group(function () {
    // User
    Route::middleware(['admin'])->group(function () {
        Route::get('/beranda', [UserController::class, 'index']);
    });
    Route::middleware(['admin'])->group(function () {
        Route::get('/riwayat', [UserController::class, 'riwayat']);
    });
    Route::middleware(['admin'])->group(function () {
        Route::get('/bantuan', [UserController::class, 'bantuan']);
    });
    // Route::middleware(['admin'])->group(function () {
    //     Route::get('/profil', [UserControllertroller::class, 'profil']);
    // });
    Route::middleware(['admin'])->group(function () {
        Route::get('/daftar-sambungan', [UserController::class, 'sambungan']);
    });

    // Admin
    Route::middleware(['user'])->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard']);
    });
});
