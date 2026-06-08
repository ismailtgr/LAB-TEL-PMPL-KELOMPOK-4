<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use App\Models\User;
use App\Models\Dokumentasi;

class DosenDashboardController extends Controller
{
    public function index()
    {
        $totalKegiatan = Kegiatan::count();

        $pendingApproval = Kegiatan::where('status', 'pending')->count();

        $approved = Kegiatan::where('status', 'disetujui')->count();

        $mahasiswa = User::where('role', 'mahasiswa')->count();

        $dokumentasis = Dokumentasi::latest()
            ->latest()
            ->take(4)
            ->get();

        $pendingKegiatans = Kegiatan::with('creator')
            ->where('status', 'pending')
            ->latest()
            ->take(5)
            ->get();

        return view('dosen.dashboard', compact(
            'totalKegiatan',
            'pendingApproval',
            'approved',
            'mahasiswa',
            'dokumentasis',
            'pendingKegiatans'
        ));
    }
}
