<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailPenjualanController;
use App\Http\Controllers\UserDashboardController;
use App\Http\Controllers\KeranjangController;
use Illuminate\Support\Facades\Route;

// Redirect root ke login
Route::get('/', function () {
    return redirect()->route('login');
});

// ===== ADMIN ROUTES =====
Route::middleware(['auth', 'admin'])->group(function () {

    // Dashboard Admin
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produk
    Route::resource('produk', ProdukController::class);

    // Pelanggan
    Route::resource('pelanggan', PelangganController::class);

    // Penjualan
    Route::resource('penjualan', PenjualanController::class);

    // Detail Penjualan
    Route::get('/detailpenjualan', [DetailPenjualanController::class, 'index'])->name('detailpenjualan.index');

});

// ===== USER ROUTES =====
Route::middleware(['auth', 'user'])->group(function () {

    // Dashboard User (katalog tanaman)
    Route::get('/home', [UserDashboardController::class, 'index'])->name('user.dashboard');

    // User beli produk
    Route::post('/home/beli', [UserDashboardController::class, 'beli'])->name('user.beli');

    // Riwayat transaksi user
    Route::get('/home/riwayat', [UserDashboardController::class, 'riwayat'])->name('user.riwayat');

    Route::get('/profil', [UserDashboardController::class, 'profil'])->name('user.profil');
    
    Route::post('/profil', [UserDashboardController::class, 'updateProfil'])->name('user.profil.update');

    Route::get('/keranjang', [KeranjangController::class, 'index'])->name('user.keranjang');
    
    Route::post('/keranjang/tambah', [KeranjangController::class, 'tambah'])->name('user.keranjang.tambah');
    
    Route::post('/keranjang/update/{keranjang}', [KeranjangController::class, 'update'])->name('user.keranjang.update');
    
    Route::post('/keranjang/hapus/{keranjang}', [KeranjangController::class, 'hapus'])->name('user.keranjang.hapus');
    
    Route::post('/keranjang/checkout', [KeranjangController::class, 'checkout'])->name('user.keranjang.checkout');

});

// ===== PROFILE (semua user login) =====
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';