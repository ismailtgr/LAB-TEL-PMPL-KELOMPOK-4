<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use Illuminate\Http\Request;

class DokumentasiController extends Controller
{
    public function index()
    {
        // Mengambil semua data dokumentasi dengan fitur pagination (12 item per halaman)
        $dokumentasis = Dokumentasi::latest()->paginate(12);

        return view('mahasiswa.dokumentasi.index', compact('dokumentasis'));
    }
}