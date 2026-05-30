<?php

namespace App\Http\Controllers\Mahasiswa;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanController extends Controller
{
    // Menampilkan daftar pengajuan milik mahasiswa yang sedang login
    public function index()
    {
        $kegiatans = Kegiatan::where('created_by', Auth::id())
            ->orderBy('created_at', 'desc')
            ->paginate(10); // Menggunakan paginasi jika datanya banyak

        return view('mahasiswa.kegiatan.index', compact('kegiatans'));
    }

    // Menampilkan halaman formulir pengajuan
    public function create()
    {
        return view('mahasiswa.kegiatan.create');
    }

    // Memproses penyimpanan data dari formulir ke database
    public function store(Request $request)
    {
        // Validasi input sesuai dengan kolom di model Kegiatan
        $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal' => 'required|date|after_or_equal:today',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required|after:waktu_mulai',
            'lokasi' => 'required|string|max:255',
            'kategori' => 'required|string',
        ]);

        // Simpan data ke database
        Kegiatan::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'tanggal' => $request->tanggal,
            'waktu_mulai' => $request->waktu_mulai,
            'waktu_selesai' => $request->waktu_selesai,
            'lokasi' => $request->lokasi,
            'kategori' => $request->kategori,
            'status' => 'pending', // Default status saat baru diajukan
            'created_by' => Auth::id(), // ID mahasiswa yang mengajukan
        ]);

        // Kembali ke halaman indeks dengan pesan sukses
        return redirect()->route('mahasiswa.kegiatan.index')->with('success', 'Pengajuan kegiatan berhasil dikirim dan menunggu persetujuan dosen.');
    }
}