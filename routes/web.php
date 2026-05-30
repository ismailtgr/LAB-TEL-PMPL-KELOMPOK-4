<?php

use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ScheduleCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DokumentasiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dosen\KegiatanApprovalController;
use App\Http\Controllers\Dosen\MonitoringKegiatanController;
use App\Http\Controllers\Dosen\DosenDashboardController;
use App\Http\Controllers\Dosen\MahasiswaController;
use App\Http\Controllers\Dosen\DokumentasiController as DosenDokumentasiController;
use App\Models\Kegiatan;
use App\Models\Schedule;
use App\Http\Controllers\Mahasiswa\KegiatanController as MahasiswaKegiatanController;
use App\Http\Controllers\Mahasiswa\JadwalLabController;
use App\Http\Controllers\Mahasiswa\MahasiswaDashboardController;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return match (Auth::user()->role) {
        'admin' => redirect()->route('admin.dashboard'),
        'dosen' => redirect()->route('dosen.dashboard'),
        default => redirect()->route('mahasiswa.dashboard'),
    };
});


Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index'])
        ->name('admin.dashboard');

    Route::prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::resource('schedules', ScheduleController::class);
            Route::resource('schedule-categories', ScheduleCategoryController::class)->except(['show']);
            Route::resource('dokumentasis', DokumentasiController::class)->except(['show']);
            Route::resource('users', UserController::class)->except(['show']);
            Route::resource('users', UserController::class)->except(['show']);
        });

    Route::middleware(['auth', 'verified', 'role:dosen'])->group(function () {
        Route::get('/dosen/dashboard', function () {
            return view('dosen.dashboard');
        })->name('dosen.dashboard');
    });

    Route::middleware(['auth', 'verified', 'role:mahasiswa'])->group(function () {
        Route::get('/mahasiswa/dashboard', [MahasiswaDashboardController::class, 'index'])->name('mahasiswa.dashboard');
        Route::get('/mahasiswa/kegiatan', [MahasiswaKegiatanController::class, 'index'])->name('mahasiswa.kegiatan.index');
        Route::get('/mahasiswa/kegiatan/create', [MahasiswaKegiatanController::class, 'create'])->name('mahasiswa.kegiatan.create');
        Route::post('/mahasiswa/kegiatan', [MahasiswaKegiatanController::class, 'store'])->name('mahasiswa.kegiatan.store');
        Route::get('/jadwal', [JadwalLabController::class, 'index'])->name('mahasiswa.jadwal.index');
    });

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

        Route::get('/dokumentasi', [DosenDokumentasiController::class, 'index'])
            ->name('dokumentasi');

        Route::post('/dokumentasi', [DosenDokumentasiController::class, 'store'])
            ->name('dokumentasi.store');
    });
require __DIR__ . '/auth.php';
