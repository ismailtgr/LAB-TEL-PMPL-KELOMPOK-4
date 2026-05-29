<?php

namespace App\Http\Controllers\Dosen;

use App\Http\Controllers\Controller;
use App\Models\Kegiatan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KegiatanApprovalController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::latest()->get();

        return view('dosen.approval', compact('kegiatans'));
    }

    public function approve($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'status' => 'disetujui',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Kegiatan berhasil disetujui');
    }

    public function reject($id)
    {
        $kegiatan = Kegiatan::findOrFail($id);

        $kegiatan->update([
            'status' => 'ditolak',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Kegiatan berhasil ditolak');
    }
}
