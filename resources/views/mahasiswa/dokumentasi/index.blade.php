@extends('layouts.mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">Dokumentasi Laboratorium</h1>
            <p class="mt-1 text-sm text-gray-500">Kumpulan foto dan arsip kegiatan yang telah berlangsung di Lab TEL.</p>
        </div>
    </div>

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4">
        @forelse ($dokumentasis as $dok)
        <div class="group flex flex-col overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition">
            <div class="relative bg-gray-200">
                @if($dok->file_path)
                <img src="{{ asset('storage/' . $dok->file_path) }}" alt="Dokumentasi" class="h-48 w-full object-cover group-hover:scale-105 transition-transform duration-300">
                @else
                <div class="h-48 w-full flex items-center justify-center text-gray-400 bg-gray-100">
                    📷 No Image
                </div>
                @endif
                <div class="absolute top-2 right-2 rounded bg-black/50 px-2 py-1 text-xs font-medium text-white backdrop-blur-sm">
                    {{ $dok->created_at->translatedFormat('d M Y') }}
                </div>
            </div>
            <div class="flex flex-1 flex-col justify-between p-5">
                <div>
                    <h3 class="font-semibold text-gray-900 line-clamp-2">{{ $dok->judul ?? 'Dokumentasi' }}</h3>
                    <p class="mt-2 text-sm text-gray-500 line-clamp-3">{{ $dok->keterangan ?? $dok->deskripsi ?? 'Tidak ada keterangan tambahan.' }}</p>
                </div>
            </div>
        </div>
        @empty
        <div class="col-span-full rounded-lg border border-dashed border-gray-300 bg-white p-12 text-center">
            <span class="text-4xl text-gray-300">📷</span>
            <h3 class="mt-4 text-sm font-semibold text-gray-900">Belum Ada Dokumentasi</h3>
            <p class="mt-1 text-sm text-gray-500">Saat ini belum ada dokumentasi kegiatan yang diunggah oleh Dosen/Admin.</p>
        </div>
        @endforelse
    </div>

    @if($dokumentasis->hasPages())
    <div class="mt-6 border-t border-gray-200 pt-6">
        {{ $dokumentasis->links() }}
    </div>
    @endif
</div>
@endsection