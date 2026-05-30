@extends('layouts.mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Pengajuan Kegiatan
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola dan pantau status izin penggunaan laboratorium Anda.
            </p>
        </div>

        <a
            href="{{ route('mahasiswa.kegiatan.create') }}"
            class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]">
            + Tambah Pengajuan
        </a>
    </div>

    @if(session('success'))
    <div class="rounded-md bg-green-50 p-4 border border-green-200">
        <div class="flex">
            <div class="flex-shrink-0 text-green-400">✅</div>
            <div class="ml-3">
                <p class="text-sm font-medium text-green-800">{{ session('success') }}</p>
            </div>
        </div>
    </div>
    @endif

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Judul Kegiatan</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Tanggal & Waktu</th>
                        <th class="px-6 py-4">Lokasi</th>
                        <th class="px-6 py-4">Status</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($kegiatans as $kegiatan)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4">
                            <div class="font-medium text-gray-900">{{ $kegiatan->judul }}</div>
                            <div class="text-xs text-gray-400 max-w-xs truncate">{{ $kegiatan->deskripsi }}</div>
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-gray-100 px-2 py-1 text-xs font-medium text-gray-600 uppercase">
                                {{ $kegiatan->kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            <div>📅 {{ \Carbon\Carbon::parse($kegiatan->tanggal)->translatedFormat('d M Y') }}</div>
                            <div class="text-xs text-gray-400">🕒 {{ substr($kegiatan->waktu_mulai, 0, 5) }} - {{ substr($kegiatan->waktu_selesai, 0, 5) }} WIB</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            📍 {{ $kegiatan->lokasi }}
                        </td>
                        <td class="px-6 py-4">
                            @if($kegiatan->status === 'approved' || $kegiatan->status === 'disetujui')
                            <span class="inline-flex items-center rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                Disetujui
                            </span>
                            @elseif($kegiatan->status === 'rejected' || $kegiatan->status === 'ditolak')
                            <span class="inline-flex items-center rounded-full bg-red-100 px-3 py-1 text-xs font-semibold text-red-700">
                                Ditolak
                            </span>
                            @else
                            <span class="inline-flex items-center rounded-full bg-yellow-100 px-3 py-1 text-xs font-semibold text-yellow-700">
                                Pending
                            </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                            Belum ada riwayat pengajuan kegiatan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($kegiatans->hasPages())
        <div class="border-t border-gray-200 px-6 py-4 bg-gray-50">
            {{ $kegiatans->links() }}
        </div>
        @endif
    </div>
</div>
@endsection