<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('auth.login'); });

// LOGIN
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'prosesLogin']);

// REGISTER
Route::get('/daftar', [LoginController::class, 'daftar']);
Route::post('/daftar', [LoginController::class, 'prosesDaftar']);

// LOGOUT
Route::get('/logout', [LoginController::class, 'logout']);

// USER
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/beranda', [UserController::class, 'index']);

    Route::view('/beranda', 'user.beranda');

    Route::get('/tagihan', [PayController::class, 'tagihan'])->name('tagihan');

    Route::get('/bayar' , [PayController::class, 'bayar']);

    Route::get('/berhasil/{id}' , [PayController::class, 'berhasil'])->name('berhasil');

    Route::get('/bantuan', [UserController::class, 'bantuan']);

    Route::get('/profil/{id}', [UserController::class, 'profil']);

    Route::get('/daftar-sambungan', [UserController::class, 'sambungan']);

    Route::post('/prosesDaftar' , [UserController::class, 'prosesDaftar']);
    
    Route::view('/succes', 'user.succes');

    Route::put('/updateProfil/{id}', [UserController::class, 'updateProfil']);

    Route::put('/updateLangganan/{id}', [UserController::class, 'updateLangganan']);
}); 

// Super Admin
Route::middleware(['auth', 'user'])->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard']);

    Route::get('/daftar-manual', [AdminController::class, 'daftarManual']);

    Route::get('/hapus-pelanggan/{id}', [AdminController::class, 'hapusPelanggan']);

    Route::POST('/prosesManual', [AdminController::class, 'prosesManual']);

    Route::get('/detail-user/{id}', [AdminController::class, 'detailUser']);

    Route::get('/manage-unit', [AdminController::class, 'unit']);

    Route::post('/tambah-unit', [AdminController::class, 'tambahUnit']);

    Route::get('/hapus-unit/{kd_unit}', [AdminController::class, 'hapusUnit']);

    Route::put('/edit-unit/{kd_unit}', [AdminController::class, 'editUnit']);

    Route::get('/admin-unit', [AdminController::class, 'adminUnit']);

    Route::post('/tambah-admin-unit', [AdminController::class, 'tambahAdminUnit']);

});

// Unit

Route::get('/unit', [UnitController::class, 'index']);

// Pegawai

Route::get('/pegawai', [PegawaiController::class, 'index']);



Route::view('/pengaturan', 'user.pengaturan');

// Route::view('/unit', 'unit.dashboard');


// Route::middleware(['isAuth'])->group(function () {
//     // User
    
// });

// Route::get('/detail-user/{id}', [AdminController::class, 'detailUser']);
// Route::post('/prosesDaftar', [UserController::class, 'prosesDaftar']);