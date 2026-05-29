<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\KegiatanApprovalController;
use App\Http\Controllers\Dosen\MonitoringKegiatanController;
use App\Http\Controllers\Dosen\DosenDashboardController;
use App\Http\Controllers\Dosen\MahasiswaController;
use App\Http\Controllers\Dosen\DokumentasiController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'role:dosen'])
    ->prefix('dosen')
    ->name('dosen.')
    ->group(function () {

        /*
        |--------------------------------------------------------------------------
        | Dashboard
        |--------------------------------------------------------------------------
        */

        Route::get('/dashboard', [DosenDashboardController::class, 'index'])
            ->name('dashboard');

        /*
        |--------------------------------------------------------------------------
        | Monitoring Kegiatan
        |--------------------------------------------------------------------------
        */

        Route::get('/monitoring', [MonitoringKegiatanController::class, 'index'])
            ->name('monitoring');

        Route::get('/kegiatan/{id}', [MonitoringKegiatanController::class, 'show'])
            ->name('kegiatan.show');

        Route::get('/kegiatan/{id}', [MonitoringKegiatanController::class, 'show'])
            ->name('kegiatan.show');

        /*
        |--------------------------------------------------------------------------
        | Approval Kegiatan
        |--------------------------------------------------------------------------
        */

        Route::get('/approval', [KegiatanApprovalController::class, 'index'])
            ->name('approval');

        Route::patch('/approval/{id}/approve', [KegiatanApprovalController::class, 'approve'])
            ->name('approval.approve');

        Route::patch('/approval/{id}/reject', [KegiatanApprovalController::class, 'reject'])
            ->name('approval.reject');

        /*
        |--------------------------------------------------------------------------
        | Mahasiswa
        |--------------------------------------------------------------------------
        */

        Route::get('/mahasiswa', [MahasiswaController::class, 'index'])
            ->name('mahasiswa');

        /*
        |--------------------------------------------------------------------------
        | Dokumentasi
        |--------------------------------------------------------------------------
        */

        Route::get('/dokumentasi', [DokumentasiController::class, 'index'])
            ->name('dokumentasi');

        Route::post('/dokumentasi', [DokumentasiController::class, 'store'])
            ->name('dokumentasi.store');
    });

require __DIR__ . '/auth.php';
