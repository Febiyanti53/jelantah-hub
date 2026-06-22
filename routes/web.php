<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SetoranController; 
use App\Http\Controllers\StakeholderController; // Pastikan ini diimpor
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

// =========================================================================
// GRUP RUTE OPERASIONAL (Wajib Login, Terverifikasi, & SUDAH SET LOKASI)
// =========================================================================
Route::middleware(['auth', 'verified', \App\Http\Middleware\CheckLocationSetup::class])->group(function () {
    
    // ---------------------------------------------------------------------
    // PERAN: MASYARAKAT
    // ---------------------------------------------------------------------
    // 1. Dashboard Utama Warga (Melihat Angka Statistik / Ringkasan)
    Route::get('/masyarakat/dashboard', [SetoranController::class, 'dashboardMasyarakat'])->name('masyarakat.dashboard');
    
    // 2. Halaman Riwayat Halaman Terpisah (Melihat Tabel Log Riwayat)
    Route::get('/masyarakat/riwayat', [SetoranController::class, 'riwayatMasyarakat'])->name('masyarakat.riwayat');
    
    // 3. Fitur CRUD Setoran Minyak Jelantah
    Route::get('/masyarakat/setoran/baru', [SetoranController::class, 'createMasyarakat'])->name('masyarakat.setoran.create');
    Route::post('/masyarakat/setoran', [SetoranController::class, 'storeMasyarakat'])->name('masyarakat.setoran.store');
    Route::get('/masyarakat/setoran/{id}/edit', [SetoranController::class, 'editMasyarakat'])->name('masyarakat.setoran.edit');
    Route::put('/masyarakat/setoran/{id}', [SetoranController::class, 'updateMasyarakat'])->name('masyarakat.setoran.update');
    Route::delete('/masyarakat/setoran/{id}', [SetoranController::class, 'destroyMasyarakat'])->name('masyarakat.setoran.destroy');
    Route::get('/masyarakat/pengepul-terdekat', [App\Http\Controllers\Masyarakat\PengepulController::class, 'index'])
        ->name('masyarakat.pengepul.terdekat');
    // ---------------------------------------------------------------------
    // PERAN: PENGEPUL
    // ---------------------------------------------------------------------
    Route::get('/pengepul/dashboard', function () {
        if (Auth::user()->role !== 'pengepul') {
            return redirect('/' . Auth::user()->role . '/dashboard');
        }
        return view('dashboard.pengepul'); 
    })->name('pengepul.dashboard');

   // ---------------------------------------------------------------------
    // PERAN: STAKEHOLDER (HEN)
    // ---------------------------------------------------------------------
    // 1. Dashboard Utama Eksekutif
    Route::get('/stakeholder/dashboard', [StakeholderController::class, 'index'])->name('stakeholder.dashboard');
    
    // 2. Halaman Log Audit Transaksi Terpisah (Rute yang memicu error sebelumnya)
    Route::get('/stakeholder/audit-log', [StakeholderController::class, 'auditLog'])->name('stakeholder.audit');
    
    // 3. Alur Kendali Mutu Hasil Uji Laboratorium
    Route::get('/stakeholder/setoran/{id}/lab', [StakeholderController::class, 'editLab'])->name('stakeholder.lab.edit');
    Route::patch('/stakeholder/setoran/{id}/lab', [StakeholderController::class, 'updateLab'])->name('stakeholder.lab.update');
    });

// =========================================================================
// GRUP RUTE PROFIL USER (Bebas dari pengecekan lokasi agar bisa update data)
// =========================================================================
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';