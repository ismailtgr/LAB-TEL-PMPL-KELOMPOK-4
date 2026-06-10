<?php

namespace App\Http\Controllers\Dosen;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index()
    {
        $dokumentasis = Dokumentasi::with('kegiatan')
            ->latest()
            ->get();

        $kegiatans = Kegiatan::all();

        return view('dosen.dokumentasi', compact(
            'dokumentasis',
            'kegiatans'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'kegiatan_id' => 'required|exists:kegiatans,id',
            'foto' => 'required|image|mimes:jpg,jpeg,png|max:2048',
            'caption' => 'nullable|string|max:255',
        ]);

        $kegiatan = Kegiatan::findOrFail($request->kegiatan_id);
        $judulOtomatis = $kegiatan->nama_kegiatan ?? $kegiatan->judul ?? $kegiatan->title ?? 'Dokumentasi Kegiatan';

        $file = $request->file('foto');

        $path = $request->file('foto')->store('dokumentasi', 'public');

        $fileName = $file->getClientOriginalName();       // Contoh: kegiatan.png
        $fileType = $file->getClientOriginalExtension();  // Contoh: png
        $mimeType = $file->getMimeType();                 // Contoh: image/png
        $fileSize = $file->getSize();

        Dokumentasi::create([
            'kegiatan_id' => $request->kegiatan_id,
            'judul' => $judulOtomatis,
            'file_path' => $path,
            'file_name' => $fileName,
            'file_type' => $fileType,
            'mime_type' => $mimeType,
            'file_size' => $fileSize,
            'deskripsi' => $request->caption,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()
            ->route('dosen.dashboard')
            ->with('success', 'Dokumentasi berhasil diupload.');
    }
}
