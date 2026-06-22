<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetoranController; 
use App\Http\Controllers\StakeholderController;
use App\Http\Controllers\Pengepul\HargaController;
use App\Http\Controllers\Pengepul\PengirimanController;
use App\Http\Controllers\Masyarakat\PengepulController as MasyarakatPengepulController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// GRUP RUTE OPERASIONAL (Wajib Login, Terverifikasi, & Sudah Set Lokasi)
// =========================================================================
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckLocationSetup::class])->group(function () {
    
    // PERAN: MASYARAKAT
    Route::prefix('masyarakat')->name('masyarakat.')->group(function () {
        Route::get('/dashboard', [SetoranController::class, 'dashboardMasyarakat'])->name('dashboard');
        Route::get('/riwayat', [SetoranController::class, 'riwayatMasyarakat'])->name('riwayat');
        
        // CRUD Setoran
        Route::get('/setoran/baru', [SetoranController::class, 'createMasyarakat'])->name('setoran.create');
        Route::post('/setoran', [SetoranController::class, 'storeMasyarakat'])->name('setoran.store');
        Route::get('/setoran/{id}/edit', [SetoranController::class, 'editMasyarakat'])->name('setoran.edit');
        Route::put('/setoran/{id}', [SetoranController::class, 'updateMasyarakat'])->name('setoran.update');
        Route::delete('/setoran/{id}', [SetoranController::class, 'destroyMasyarakat'])->name('setoran.destroy');
        
        // Cari Pengepul Terdekat
        Route::get('/pengepul-terdekat', [MasyarakatPengepulController::class, 'index'])->name('pengepul.terdekat');
    });

    // PERAN: PENGEPUL
    Route::prefix('pengepul')->name('pengepul.')->group(function () {
        // Dashboard
        Route::get('/dashboard', function () {
            if (Auth::user()->role !== 'pengepul') {
                return redirect('/' . Auth::user()->role . '/dashboard');
            }
            return view('dashboard.pengepul'); 
        })->name('dashboard');

        // 1. Atur Harga Beli (Kaskade Harga)
        Route::get('/harga', [HargaController::class, 'index'])->name('harga.index');
        Route::post('/harga', [HargaController::class, 'store'])->name('harga.store');

        Route::get('/setoran', [SetoranController::class, 'indexPengepul'])->name('setoran.index');

        // 2. Setoran Masuk dari Masyarakat
Route::get('/setoran', [SetoranController::class, 'indexPengepul'])->name('setoran.index');
Route::post('/setoran/{id}/uji', [SetoranController::class, 'simpanUjiPengepul'])->name('setoran.simpan-uji'); 

        // 3. Kirim ke PT HEN & Riwayat Lab
        Route::get('/pengiriman', [PengirimanController::class, 'index'])->name('pengiriman.index');
        Route::get('/pengiriman/kirim', [PengirimanController::class, 'create'])->name('pengiriman.create');
        Route::post('/pengiriman', [PengirimanController::class, 'store'])->name('pengiriman.store');
    });

    // PERAN: STAKEHOLDER (HEN)
    Route::prefix('stakeholder')->name('stakeholder.')->group(function () {
        Route::get('/dashboard', [StakeholderController::class, 'index'])->name('dashboard');
        Route::get('/audit-log', [StakeholderController::class, 'auditLog'])->name('audit');
        
        // Kendali Mutu Hasil Uji Lab
        Route::get('/setoran/{id}/lab', [StakeholderController::class, 'editLab'])->name('lab.edit');
        Route::patch('/setoran/{id}/lab', [StakeholderController::class, 'updateLab'])->name('lab.update');
    });

});

// =========================================================================
// GRUP RUTE PROFIL USER
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';