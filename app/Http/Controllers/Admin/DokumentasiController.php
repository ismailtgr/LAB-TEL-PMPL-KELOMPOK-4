<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Dokumentasi;
use App\Models\Schedule;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DokumentasiController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->query('search');
        $fileType = $request->query('file_type');
        $kegiatanId = $request->query('kegiatan_id');

        $dokumentasis = Dokumentasi::with(['kegiatan', 'uploader'])
            ->when($search, function ($query, $search) {
                $query->where(function ($query) use ($search) {
                    $query->where('judul', 'like', '%' . $search . '%')
                        ->orWhere('deskripsi', 'like', '%' . $search . '%')
                        ->orWhere('file_name', 'like', '%' . $search . '%');
                });
            })
            ->when($fileType, function ($query, $fileType) {
                $query->where('file_type', $fileType);
            })
            ->when($kegiatanId, function ($query, $kegiatanId) {
                $query->where('kegiatan_id', $kegiatanId);
            })
            ->latest()
            ->get();

        $schedules = Schedule::orderBy('date', 'desc')->get();

        return view('admin.dokumentasis.index', compact(
            'dokumentasis',
            'schedules',
            'search',
            'fileType',
            'kegiatanId'
        ));
    }

    public function create()
    {
        $schedules = Schedule::latest()->get();

        return view('admin.dokumentasis.create', compact('schedules'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'kegiatan_id' => ['nullable', 'exists:schedules,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => [
                'required',
                'file',
                'mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm,pdf,doc,docx,ppt,pptx',
                'max:51200',
            ],
        ]);

        $file = $request->file('file');
        $path = $file->store('dokumentasis', 'public');

        Dokumentasi::create([
            'kegiatan_id' => $validated['kegiatan_id'] ?? null,
            'uploaded_by' => auth()->id(),
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'file_path' => $path,
            'file_name' => $file->getClientOriginalName(),
            'file_type' => $this->getFileType($file->getMimeType()),
            'mime_type' => $file->getMimeType(),
            'file_size' => $file->getSize(),
        ]);

        return redirect()
            ->route('admin.dokumentasis.index')
            ->with('success', 'Dokumentasi berhasil diunggah.');
    }

    public function edit(Dokumentasi $dokumentasi)
    {
        $schedules = Schedule::latest()->get();

        return view('admin.dokumentasis.edit', compact('dokumentasi', 'schedules'));
    }

    public function update(Request $request, Dokumentasi $dokumentasi)
    {
        $validated = $request->validate([
            'kegiatan_id' => ['nullable', 'exists:schedules,id'],
            'judul' => ['required', 'string', 'max:255'],
            'deskripsi' => ['nullable', 'string'],
            'file' => [
                'nullable',
                'file',
                'mimes:jpg,jpeg,png,webp,mp4,mov,avi,webm,pdf,doc,docx,ppt,pptx',
                'max:51200',
            ],
        ]);

        $data = [
            'kegiatan_id' => $validated['kegiatan_id'] ?? null,
            'judul' => $validated['judul'],
            'deskripsi' => $validated['deskripsi'] ?? null,
        ];

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($dokumentasi->file_path);

            $file = $request->file('file');
            $path = $file->store('dokumentasis', 'public');

            $data['file_path'] = $path;
            $data['file_name'] = $file->getClientOriginalName();
            $data['file_type'] = $this->getFileType($file->getMimeType());
            $data['mime_type'] = $file->getMimeType();
            $data['file_size'] = $file->getSize();
        }

        $dokumentasi->update($data);

        return redirect()
            ->route('admin.dokumentasis.index')
            ->with('success', 'Dokumentasi berhasil diperbarui.');
    }

    public function destroy(Dokumentasi $dokumentasi)
    {
        Storage::disk('public')->delete($dokumentasi->file_path);

        $dokumentasi->delete();

        return redirect()
            ->route('admin.dokumentasis.index')
            ->with('success', 'Dokumentasi berhasil dihapus.');
    }

    private function getFileType(?string $mimeType): string
    {
        if (! $mimeType) {
            return 'other';
        }

        if (str_starts_with($mimeType, 'image/')) {
            return 'image';
        }

        if (str_starts_with($mimeType, 'video/')) {
            return 'video';
        }

        if (in_array($mimeType, [
            'application/pdf',
            'application/msword',
            'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
            'application/vnd.ms-powerpoint',
            'application/vnd.openxmlformats-officedocument.presentationml.presentation',
        ])) {
            return 'document';
        }

        return 'other';
    }
}
