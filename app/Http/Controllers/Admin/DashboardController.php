<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Models\ScheduleCategory;
use App\Models\User;
use App\Models\Dokumentasi;

class DashboardController extends Controller
{
    public function index()
    {
        $labAktif = ScheduleCategory::count();

        $dokumen = Dokumentasi::count();

        // Kalau nanti sudah ada role mahasiswa, bisa diganti jadi:
        // User::where('role', 'mahasiswa')->count();
        $mahasiswa = User::count();

        $totalJadwal = Schedule::count();
        $jadwalSelesai = Schedule::where('status', 'selesai')->count();

        $penyelesaian = $totalJadwal > 0
            ? round(($jadwalSelesai / $totalJadwal) * 100)
            : 0;

        $upcomingSchedules = Schedule::with('category')
            ->where('status', 'mendatang')
            ->orderBy('date')
            ->orderBy('start_time')
            ->take(3)
            ->get();

        return view('admin.dashboard', compact(
            'labAktif',
            'dokumen',
            'mahasiswa',
            'penyelesaian',
            'upcomingSchedules'
        ));
    }
}