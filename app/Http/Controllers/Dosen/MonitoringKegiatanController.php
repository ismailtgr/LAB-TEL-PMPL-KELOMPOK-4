<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;

class MonitoringKegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();

        return view('dosen.monitoring', compact('kegiatans'));
    }

    public function show($id)
    {
        $kegiatan = Kegiatan::with('creator')->findOrFail($id);

        return view('dosen.detail-kegiatan', compact('kegiatan'));
    }
}
