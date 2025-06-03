<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BerandaController;
use App\Http\Controllers\AdminRotiController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;

// Redirect ke beranda jika sudah login
Route::get('/', function () {
    if (FacadesAuth::check()) {
        return redirect()->route('beranda');
    }
    return redirect()->route('login');
});



// ✅ Grup route untuk admin (dengan middleware 'auth' & 'admin')
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminRotiController::class, 'index'])->name('admin.dashboard');
    Route::get('/transactions', [AdminRotiController::class, 'transactions'])->name('admin.transactions');
    Route::get('/users', [AdminRotiController::class, 'users'])->name('admin.users');
    Route::delete('/admin/transaksi/{id}', [AdminRotiController::class, 'destroy'])->name('admin.transaksi.destroy');

});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ✅ Beranda user biasa
Route::get('/beranda', [BerandaController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('beranda');

// ✅ Grup route untuk user biasa (auth)
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::post('/checkout/add/{id}', [CheckoutController::class, 'add'])->name('checkout.add');
    Route::get('/checkout', [CheckoutController::class, 'view'])->name('checkout.view');
    Route::post('/checkout/bayar', [CheckoutController::class, 'bayar'])->name('checkout.bayar');
});

require __DIR__.'/auth.php';
