<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    $role = auth()->user()->role;

    if ($role === 'admin') {
        return redirect()->route('admin.dashboard');
    } elseif ($role === 'mitra') {
        return redirect()->route('mitra.dashboard');
    }

    return redirect()->route('umkm.dashboard');
})->middleware(['auth'])->name('dashboard');

//Admin
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard'); // Pastikan Caca buat folder admin/dashboard.blade.php
    })->name('admin.dashboard');
});

// UMKM
Route::middleware(['auth', 'role:umkm'])->group(function () {
    // Dashboard Utama UMKM
    Route::get('/umkm/dashboard', [UmkmController::class, 'index'])->name('umkm.dashboard');

    // Proses Input Data (Profil UMKM)
    Route::get('/umkm/input-data', [UmkmController::class, 'create'])->name('umkm.input');
    Route::post('/umkm/input-data', [UmkmController::class, 'store'])->name('umkm.store');
    
    // Proses Edit Data
    Route::get('/umkm/edit-data', [UmkmController::class, 'edit'])->name('umkm.edit');
    Route::patch('/umkm/edit-data', [UmkmController::class, 'update'])->name('umkm.update');
    
    // Fitur Paylater/Pinjaman
    Route::post('/umkm/ajukan-pinjaman', [UmkmController::class, 'ajukanPinjaman'])->name('umkm.ajukan-pinjaman');
    Route::get('/umkm/cetak-bukti/{id}', [UmkmController::class, 'cetakBukti'])->name('umkm.cetak-bukti');
    Route::get('/umkm/bayar/{id_pinjaman}', [UmkmController::class, 'bayar'])->name('umkm.bayar');
    // Catatan: Route umkm.create dan umkm.store yang duplikat di bawah sudah dihapus 
    // karena sudah diwakili oleh umkm.input dan umkm.store di atas.
});
// Mitra
Route::middleware(['auth', 'role:mitra'])->group(function () {
    Route::get('/mitra/dashboard', function () {
        return view('mitra.dashboard'); // Pastikan Caca buat folder mitra/dashboard.blade.php
    })->name('mitra.dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
