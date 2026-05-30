<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MahasiswaDashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // 1. Data untuk Kartu Ringkasan (Bagian Atas Dashboard)
        $totalPengajuan = Kegiatan::where('created_by', $user->id)->count();
        $pendingApproval = Kegiatan::where('created_by', $user->id)->where('status', 'pending')->count();
        $disetujui = Kegiatan::where('created_by', $user->id)->where('status', 'approved')->count();

        // 2. Data "Status Pengajuan Saya"
        $myKegiatans = Kegiatan::where('created_by', $user->id)
            ->orderBy('created_at', 'desc')
            ->take(5)
            ->get();

        // 3. Data "Jadwal Lab Mendatang" (Sudah disetujui & tanggalnya ke depan)
        $jadwalMendatang = Kegiatan::whereIn('status', ['approved', 'disetujui'])
            ->where('tanggal', '>=', Carbon::today())
            ->orderBy('tanggal', 'asc')
            ->orderBy('waktu_mulai', 'asc')
            ->take(3)
            ->get();

        // Kirim 5 variabel ini ke view dashboard
        return view('mahasiswa.dashboard', compact(
            'totalPengajuan',
            'pendingApproval',
            'disetujui',
            'myKegiatans',
            'jadwalMendatang'
        ));
    }
}