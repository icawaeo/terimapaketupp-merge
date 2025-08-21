<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\PaketController;
use App\Http\Controllers\Admin\HistoryController;
use App\Http\Controllers\Admin\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Rute untuk Dashboard Publik
Route::get('/', [PaketController::class, 'create'])->name('paket.create');
Route::post('/paket', [PaketController::class, 'store'])->name('paket.public.store');

// Rute default dari Breeze, mengarahkan ke halaman admin kita
Route::get('/dashboard', function () {
    return redirect()->route('admin.index');
})->middleware(['auth', 'verified'])->name('dashboard');

// Grup Rute untuk Halaman Admin
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    // Rute yang bisa diakses semua admin (Paket & History)
    Route::get('/', [PaketController::class, 'index'])->name('index');
    Route::get('/paket/create', [PaketController::class, 'create'])->name('paket.create');
    Route::post('/paket', [PaketController::class, 'store'])->name('paket.store');
    Route::patch('/paket/{paket}/ambil', [PaketController::class, 'tandaiDiambil'])->name('paket.ambil');
    Route::get('/history', [HistoryController::class, 'index'])->name('history.index');

    // Grup Rute yang HANYA bisa diakses oleh Super Admin
    Route::middleware('superadmin')->group(function () {
        Route::get('/users', [UserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
        Route::post('/users', [UserController::class, 'store'])->name('users.store');
        Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('users.destroy');
    });
});

// Grup Rute untuk profil pengguna dari Breeze
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Ini akan memuat rute login, register, dll. dari Breeze.
require __DIR__.'/auth.php';