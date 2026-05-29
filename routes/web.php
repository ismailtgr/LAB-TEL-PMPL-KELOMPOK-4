<?php

use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ScheduleCategoryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DokumentasiController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
        Route::get('/mahasiswa/dashboard', function () {
            return view('mahasiswa.dashboard');
        })->name('mahasiswa.dashboard');
    });

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
