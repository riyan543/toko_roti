<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminRotiController;
use App\Http\Controllers\Api\RotiApiController;

// Redirect ke beranda jika sudah login
Route::get('/', function () {
    return FacadesAuth::check()
        ? redirect()->route('beranda')
        : redirect()->route('login');
});

// ====================
// ✅ REST API
// ====================

Route::get('/api', [RotiApiController::class, 'index']);
Route::get('/tes-api', fn () => ['pesan' => 'API aktif']);
Route::get('/daftar-roti', function () {
    return view('api');
});

// ====================
// ✅ User Terautentikasi
// ====================
Route::middleware(['auth'])->group(function () {

    // ➤ Beranda pengguna biasa
    Route::get('/beranda', [BerandaController::class, 'index'])
        ->middleware('verified')
        ->name('beranda');

    // ➤ Profil pengguna
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ➤ Checkout & Keranjang
    Route::get('/checkout', [CheckoutController::class, 'view'])->name('checkout.view');
    Route::post('/checkout/add/{id}', [CheckoutController::class, 'add'])->name('checkout.add');
    Route::post('/checkout/bayar', [CheckoutController::class, 'bayar'])->name('checkout.bayar');
    Route::get('/checkout/pembayaran', [CheckoutController::class, 'pembayaran'])->name('checkout.pembayaran');
    Route::delete('/checkout/hapus/{id}', [CheckoutController::class, 'hapus'])->name('checkout.hapus');

});

// ====================
// ✅ Admin Panel
// ====================
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminRotiController::class, 'index'])->name('admin.dashboard');
    Route::get('/transactions', [AdminRotiController::class, 'transactions'])->name('admin.transactions');
    Route::get('/users', [AdminRotiController::class, 'users'])->name('admin.users');
    Route::delete('/admin/transaksi/{id}', [AdminRotiController::class, 'destroy'])->name('admin.transaksi.destroy');
    Route::get('/admin/transaksi/{id}', [AdminRotiController::class, 'show'])->name('admin.detailtransaksi');

});

// ====================
// ✅ Auth routes
// ====================
require __DIR__.'/auth.php';
