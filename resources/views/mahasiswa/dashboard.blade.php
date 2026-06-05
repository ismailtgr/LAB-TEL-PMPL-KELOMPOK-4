@extends('layouts.mahasiswa')

@section('content')
<div>
    <h1 class="text-3xl font-semibold text-gray-900">
        Dashboard Mahasiswa
    </h1>
    <p class="mt-2 text-sm text-gray-500">
        Selamat datang kembali, {{ Auth::user()->name }}! Berikut adalah ringkasan aktivitas Anda di laboratorium.
    </p>
</div>

<div class="mt-7 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-gray-500">Total Pengajuan Saya</p>
        <p class="mt-3 text-3xl font-semibold text-[#1F2587]">
            {{ $totalPengajuan }}
        </p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-gray-500">Menunggu Approval</p>
        <p class="mt-3 text-3xl font-semibold text-yellow-500">
            {{ $pendingApproval }}
        </p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <p class="text-sm text-gray-500">Kegiatan Disetujui</p>
        <p class="mt-3 text-3xl font-semibold text-green-500">
            {{ $disetujui }}
        </p>
    </div>
</div>

<div class="mt-7 grid grid-cols-1 gap-7 lg:grid-cols-2">
    <section class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">Jadwal Lab Mendatang</h2>
            <a href="{{ route('mahasiswa.jadwal.index') }}" class="text-sm font-medium text-[#1F2587] hover:underline">Lihat Semua</a>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($jadwalMendatang as $jadwal)
            <div class="px-6 py-4 hover:bg-gray-50 transition">
                <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-2">
                    <div>
                        <h3 class="font-medium text-gray-900">{{ $jadwal->judul }}</h3>
                        <p class="text-xs text-gray-400 mt-0.5">👤 {{ $jadwal->user->name ?? 'Mahasiswa Lab TEL' }}</p>
                    </div>
                    <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-0.5 text-xs font-medium text-blue-700 uppercase border border-blue-100 self-start sm:self-center">
                        {{ $jadwal->kategori }}
                    </span>
                </div>
                <div class="mt-2.5 flex items-center gap-4 text-xs text-gray-500">
                    <span>📅 {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}</span>
                    <span>🕒 {{ substr($jadwal->waktu_mulai, 0, 5) }} - {{ substr($jadwal->waktu_selesai, 0, 5) }} WIB</span>
                    <span>📍 {{ $jadwal->lokasi }}</span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-gray-500">
                Belum ada jadwal kegiatan laboratorium terdekat.
            </div>
            @endforelse
        </div>
    </section>

    <section class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5 flex justify-between items-center">
            <h2 class="text-lg font-semibold text-gray-900">
                Status Pengajuan Saya
            </h2>
            <a href="{{ route('mahasiswa.kegiatan.index') }}" class="text-sm font-medium text-[#1F2587] hover:underline">Lihat Semua</a>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($myKegiatans as $kegiatan)
            <div class="px-6 py-5">
                <div class="flex justify-between items-start">
                    <div>
                        <h3 class="font-semibold text-gray-900">
                            {{ $kegiatan->judul }}
                        </h3>
                        <p class="mt-1 text-sm text-gray-500">
                            Kategori: {{ ucfirst($kegiatan->kategori) }}
                        </p>
                    </div>
                    <span class="rounded-full px-3 py-1 text-xs font-semibold 
                        {{ ($kegiatan->status === 'approved' || $kegiatan->status === 'disetujui') ? 'bg-green-100 text-green-700' : 
                           (($kegiatan->status === 'rejected' || $kegiatan->status === 'ditolak' || $kegiatan->status === 'rejected') ? 'bg-red-100 text-red-700' : 
                           'bg-yellow-100 text-yellow-700') }}">

                        {{ ($kegiatan->status === 'approved' || $kegiatan->status === 'disetujui') ? 'Disetujui' : 
                           (($kegiatan->status === 'rejected' || $kegiatan->status === 'ditolak') ? 'Ditolak' : 'Pending') }}
                    </span>
                </div>
                <div class="mt-3 flex items-center gap-6 text-sm text-gray-500">
                    <span>📅 {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d F Y') }}</span>
                    <span>📍 {{ $kegiatan->lokasi }}</span>
                </div>
            </div>
            @empty
            <div class="px-6 py-8 text-center text-sm text-gray-500">
                Anda belum mengajukan kegiatan apapun.
            </div>
            @endforelse
        </div>
    </section>
</div>
<section class="mt-7 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
    <div class="border-b border-gray-200 px-6 py-5 flex justify-between items-center">
        <div>
            <h2 class="text-lg font-semibold text-gray-900">Dokumentasi Kegiatan Lab</h2>
            <p class="text-sm text-gray-500 mt-1">Galeri foto kegiatan yang telah berlangsung di laboratorium.</p>
        </div>
        <a href="{{ route('mahasiswa.dokumentasi.index') }}" class="text-sm font-medium text-[#1F2587] hover:underline whitespace-nowrap">
            Lihat Semua
        </a>
    </div>

    <div class="p-6 bg-gray-50">
        <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4">
            @forelse ($recentDokumentasi as $dok)
            <div class="group overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm hover:shadow-md transition">
                <div class="aspect-w-16 aspect-h-10 bg-gray-200 overflow-hidden">
                    @if($dok->file_path)
                    <img src="{{ asset('storage/' . $dok->file_path) }}" alt="Dokumentasi" class="h-40 w-full object-cover group-hover:scale-105 transition-transform duration-300">
                    @else
                    <div class="h-40 w-full flex items-center justify-center text-gray-400 bg-gray-100">
                        📷 No Image
                    </div>
                    @endif
                </div>
                <div class="p-4">
                    <h3 class="font-medium text-gray-900 line-clamp-1">{{ $dok->judul ?? 'Dokumentasi Lab' }}</h3>
                    <p class="mt-1 text-xs text-gray-500 line-clamp-2">{{ $dok->keterangan ?? $dok->deskripsi ?? 'Tidak ada keterangan.' }}</p>
                    <p class="mt-3 text-xs text-gray-400">📅 {{ $dok->created_at->translatedFormat('d M Y') }}</p>
                </div>
            </div>
            @empty
            <div class="col-span-full py-8 text-center text-sm text-gray-500">
                Belum ada dokumentasi kegiatan yang diunggah.
            </div>
            @endforelse
        </div>
    </div>
</section>
</div>

@endsection