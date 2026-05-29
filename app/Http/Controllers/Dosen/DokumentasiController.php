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

        $path = $request->file('foto')->store('dokumentasi', 'public');

        Dokumentasi::create([
            'kegiatan_id' => $request->kegiatan_id,
            'file_path' => $path,
            'caption' => $request->caption,
            'uploaded_by' => Auth::id(),
        ]);

        return redirect()
            ->route('dosen.dokumentasi')
            ->with('success', 'Dokumentasi berhasil diupload.');
    }
}
