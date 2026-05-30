<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;

class JadwalLabController extends Controller
{
    public function index()
    {
        // Mengambil kegiatan yang statusnya disetujui, diurutkan dari tanggal terdekat
        $jadwalLabs = Kegiatan::whereIn('status', ['approved', 'disetujui'])
            ->orderBy('tanggal', 'asc')
            ->orderBy('waktu_mulai', 'asc')
            ->get();

        // Mengirimkan data ke view mahasiswa/jadwal/index.blade.php
        return view('mahasiswa.jadwal.index', compact('jadwalLabs'));
    }
}