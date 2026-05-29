<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\KegiatanApprovalController;

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

        Route::get('/dashboard', function () {
            return view('dosen.dashboard');
        })->name('dashboard');

        Route::get('/kegiatan', function () {
            return 'Halaman Monitoring Kegiatan';
        })->name('kegiatan.index');

        Route::get('/approval', function () {
            return view('dosen.approval');
        })->name('approval');

        Route::get('/mahasiswa', function () {
            return 'Halaman Mahasiswa';
        })->name('mahasiswa');

        Route::get('/dokumentasi', function () {
            return 'Halaman Dokumentasi';
        })->name('dokumentasi');

        Route::get('/approval', [KegiatanApprovalController::class, 'index'])
            ->name('approval');

        Route::patch('/approval/{id}/approve', [KegiatanApprovalController::class, 'approve'])
            ->name('approval.approve');

        Route::patch('/approval/{id}/reject', [KegiatanApprovalController::class, 'reject'])
            ->name('approval.reject');
    });

require __DIR__ . '/auth.php';
