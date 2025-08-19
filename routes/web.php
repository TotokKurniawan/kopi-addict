<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MejaController;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\PengaturanController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransaksiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', [LoginController::class, 'showLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/dashboard', [AdminController::class, 'dashboardadmin'])->name('dashboard');

Route::get('/menu', [AdminController::class, 'menu'])->name('menu');
Route::put('/menu/{id}/updateadmin', [MenuController::class, 'updateMenuAdmin']);
Route::delete('/menu/{id}/deleteadmin', [MenuController::class, 'deleteMenuAdmin']);

Route::get('/meja', [AdminController::class, 'meja'])->name('meja');
Route::post('/meja/reservasiadmin/{id}', [MejaController::class, 'reservasiadmin'])->name('meja.reservasiadmin');

Route::get('/tambahMenu', [AdminController::class, 'tambahMenu'])->name('tambahMenu');
Route::post('/menu/storeadmin', [MenuController::class, 'storeMenuAdmin'])->name('storeMenuAdmin');

Route::get('/tambahMeja', [AdminController::class, 'tambahMeja'])->name('tambahMeja');
Route::post('/meja/storeadmin', [MejaController::class, 'storeadmin'])->name('meja.storeadmin');

Route::get('/transaksi', [AdminController::class, 'transaksi'])->name('transaksi');
Route::get('/laporan/export', [LaporanController::class, 'exportPdf'])->name('laporan.export');

Route::get('/transaksiPemesanan', [AdminController::class, 'transaksiPemesanan'])->name('transaksiPemesanan');
Route::post('/tambahtransaksi', [TransaksiController::class, 'store'])->name('transaksi.store')->middleware('auth');

Route::get('/pengguna', [AdminController::class, 'pengguna'])->name('pengguna');
Route::put('/pengguna/{id}', [PenggunaController::class, 'updatePengguna'])->name('updatePengguna');
Route::delete('/pengguna/{id}', [PenggunaController::class, 'deletePengguna'])->name('deletePengguna');

Route::get('/tambahPengguna', [AdminController::class, 'tambahPengguna'])->name('tambahPengguna');
Route::post('/simpan-pengguna', [PenggunaController::class, 'simpanPengguna'])->name('simpanPengguna');

Route::get('/pengaturan', [AdminController::class, 'pengaturan'])->name('pengaturan');
Route::post('/pengaturan/toko', [PengaturanController::class, 'simpanToko'])->name('simpanToko');
Route::post('/pengaturan/struk', [PengaturanController::class, 'simpanStruk'])->name('simpanStruk');

Route::get('/transaksi/struklunas/{id}', [AdminController::class, 'struk'])->name('transaksi.struklunas');

Route::get('/transaksi/struk/{id}', [TransaksiController::class, 'struk'])->name('transaksi.struk');

Route::get('/laporan', [AdminController::class, 'laporan'])->name('laporan');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [AdminController::class, 'Profile'])->name('profile');
    Route::post('/profile/updateadmin', [ProfileController::class, 'updateProfile'])->name('profile.updateadmin');
});



Route::get('/dashboardUser', [UserController::class, 'dashboard'])->name('dashboardUser');

Route::get('/mejaUser', [UserController::class, 'meja'])->name('mejaUser');
Route::post('/meja/reservasi/{id}', [MejaController::class, 'reservasi'])->name('meja.reservasi');

Route::get('/menuUser', [UserController::class, 'menu'])->name('menuUser');
Route::put('/menu/{id}/update', [MenuController::class, 'updateMenu']);
Route::delete('/menu/{id}/delete', [MenuController::class, 'deleteMenu']);

Route::get('/tambahMenuUser', [UserController::class, 'tambahmenu'])->name('tambahMenuUser');
Route::post('/menu/store', [MenuController::class, 'storeMenu'])->name('storeMenu');

Route::get('/tambahMejaUser', [UserController::class, 'tambahmeja'])->name('tambahMejaUser');
Route::post('/meja/store', [MejaController::class, 'store'])->name('meja.store');

Route::middleware('auth')->group(function () {
    Route::get('/profileUser', [UserController::class, 'Profile'])->name('profileUser');
    Route::post('/profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
});

Route::get('/transaksiPemesananUser', [UserController::class, 'transaksiPemesanan'])->name('transaksiPemesananUser');


Route::get('/transaksi/strukuser/{id}', [TransaksiController::class, 'strukuser'])->name('transaksi.strukuser');


Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


Route::post('/menu/cart', [TransaksiController::class, 'addToCart'])->name('menu.addToCart');

Route::post('/menu/bayar', [TransaksiController::class, 'bayarTerpilih'])->name('menu.bayar');
