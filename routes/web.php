<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PayController;
use App\Http\Controllers\PegawaiController;
use App\Http\Controllers\PHPMailerController;
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

// Email

// Route::get('send-email',[PHPMailerController::class, 'index'])->name('send.email');
// Route::post('send-email',[PHPMailerController::class, 'store'])->name('send.email.post');
// Route::post('/send-email', [PHPMailerController::class, 'sendEmail']);

// LOGOUT
Route::get('/logout', [LoginController::class, 'logout']);

// USER
Route::middleware(['auth', 'admin'])->group(function () {
    // Route::get('/beranda', [UserController::class, 'index']);

    Route::view('/beranda', 'user.beranda');

    Route::get('/langganan', [UserController::class, 'langganan'])->name('langganan');

    Route::get('/bayar' , [PayController::class, 'bayar']);

    Route::get('/berhasil/{id}' , [PayController::class, 'berhasil'])->name('berhasil');

    Route::get('/bantuan', [UserController::class, 'bantuan']);

    Route::get('/profil/{id}', [UserController::class, 'profil'])->name('profil');

    Route::get('/daftar-sambungan', [UserController::class, 'sambungan']);

    Route::post('/prosesDaftar' , [UserController::class, 'prosesDaftar']);
    
    Route::view('/succes', 'user.succes');

    Route::put('/updateProfil/{id}', [UserController::class, 'updateProfil']);

    Route::put('/updateLangganan/{id}', [UserController::class, 'updateLangganan']);

    Route::get('/bukti-pembayaran', [PayController::class, 'cetakPembayaran']);

    Route::get('/pengajuan', [UserController::class, 'pengajuan']);

    Route::post('/mulai-pengajuan/{id}', [UserController::class, 'mulaiPengajuan']);

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

    Route::get('/hapus-admin-unit/{id}', [AdminController::class, 'hapusAdminUnit']);

    Route::get('/semua-pelanggan', [AdminController::class, 'pelanggan']);

    Route::get('/semua-pendaftar', [AdminController::class, 'pendaftar']);

    Route::get('/profil-admin/{id}', [AdminController::class, 'profil']);

    Route::get('/detail-adminUnit/{id}', [AdminController::class, 'detailAdminUnit']);

    Route::post('/status-adminUnit/{id}', [AdminController::class, 'statusAdminUnit']);

    Route::put('/updateProfilSuperadmin/{id}', [AdminController::class, 'updateProfil']);

});

// Unit
Route::get('/unit', [UnitController::class, 'index']);
Route::post('/verif-pelanggan/{id}', [UnitController::class, 'verifPelanggan']);
Route::get('/pendaftar', [UnitController::class, 'pendaftar']);
Route::get('/calon-pelanggan', [UnitController::class, 'calonPelanggan']);
Route::get('/pelanggan', [UnitController::class, 'pelanggan']);
Route::get('/pegawai', [UnitController::class, 'pegawai']);
Route::post('/tambah-pegawai', [UnitController::class, 'tambahPegawai']);
Route::post('/status-pegawai/{id}', [UnitController::class, 'statusPegawai']);
Route::get('/detail-pegawai/{id}', [UnitController::class, 'detailPegawai']);
Route::get('/hapus-pegawai/{id}', [UnitController::class, 'hapusPegawai']);
Route::get('/profil-unit/{id}', [UnitController::class, 'profil']);
Route::put('/updateProfilUnit/{id}', [UnitController::class, 'updateProfil']);
Route::get('/riwayat-pendaftar', [UnitController::class, 'riwayatPendaftar']);
Route::get('/list-pengajuan', [UnitController::class, 'pengajuan']);
Route::get('/proses', [UnitController::class, 'prosesPengajuan']);
Route::get('/segel', [UnitController::class, 'selesaiSegel']);
Route::get('/riwayat-pengajuan', [UnitController::class, 'riwayatPengajuan']);

// Pegawai

Route::get('/dashboard-pegawai', [PegawaiController::class, 'index']);
Route::post('/mulai-pasang/{id}', [PegawaiController::class, 'mulaiPasang']);
Route::get('/list-pasang', [PegawaiController::class, 'listPasang']);
Route::get('/proses-pemasangan', [PegawaiController::class, 'prosesPemasangan']);
Route::get('/selesai-pasang', [PegawaiController::class, 'listSelesaiPemasangan']);
Route::get('/riwayat-pemasangan', [PegawaiController::class, 'riwayatPemasangan']);
Route::post('/bukti-pemasangan/{id}', [PegawaiController::class, 'buktiPemasangan'])->name('bukti.pemasangan');
Route::get('/profil-pegawai/{id}', [PegawaiController::class, 'profil']);
Route::put('/updateProfilPegawai/{id}', [PegawaiController::class, 'updateProfil']);
Route::get('/list-copot', [PegawaiController::class, 'listCopot']);
Route::post('/bukti-pencopotan/{id}', [PegawaiController::class, 'buktiPencopotan'])->name('bukti.pencopotan');
Route::get('/proses-pencopotan', [PegawaiController::class, 'prosesPencopotan']);
Route::post('/mulai-copot/{id}', [PegawaiController::class, 'mulaiCopot']);
Route::get('/selesai-copot', [PegawaiController::class, 'listSelesaiPencopotan']);
Route::get('/riwayat-pencopotan', [PegawaiController::class, 'riwayatPencopotan']);






Route::view('/pengaturan', 'user.pengaturan');

