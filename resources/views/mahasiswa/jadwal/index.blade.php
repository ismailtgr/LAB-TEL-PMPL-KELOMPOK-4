@extends('layouts.mahasiswa')

@section('content')
<div class="space-y-6">
    <div class="flex flex-col gap-4 sm:flex-row sm:items-start sm:justify-between border-b border-gray-200 pb-5">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">Jadwal Penggunaan Lab</h1>
            <p class="mt-1 text-sm text-gray-500">Lihat slot waktu dan jadwal kegiatan laboratorium TEL yang sedang berjalan.</p>
        </div>
        <div class="flex-shrink-0">
            <a href="{{ route('mahasiswa.kegiatan.create') }}"
                class="inline-flex items-center justify-center rounded-md bg-[#1F2587] px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-[#15195c] transition whitespace-nowrap">
                + Ajukan Kegiatan Anda
            </a>
        </div>
    </div>

    <div class="rounded-md bg-blue-50 p-4 border border-blue-200">
        <div class="flex">
            <div class="flex-shrink-0 text-blue-500">📢</div>
            <div class="ml-3">
                <p class="text-sm font-medium text-blue-800">
                    Silakan periksa jadwal di bawah sebelum mengajukan izin kegiatan untuk menghindari bentrok waktu penggunaan laboratorium.
                </p>
            </div>
        </div>
    </div>

    <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="p-6 border-b border-gray-200 bg-gray-50 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <h3 class="text-lg font-medium text-gray-900">Agenda Kegiatan Terdekat</h3>
            <div class="flex gap-2">
                <span class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-xs font-medium text-gray-700 border border-gray-300 shadow-sm cursor-pointer hover:bg-gray-50">Semua</span>
                <span class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-xs font-medium text-gray-500 border border-gray-200 shadow-sm cursor-pointer hover:bg-gray-50">Praktikum</span>
                <span class="inline-flex items-center rounded-md bg-white px-3 py-1.5 text-xs font-medium text-gray-500 border border-gray-200 shadow-sm cursor-pointer hover:bg-gray-50">Penelitian</span>
            </div>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full border-collapse text-left text-sm text-gray-500">
                <thead class="bg-gray-50 text-xs uppercase text-gray-700 font-semibold border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-4">Waktu & Tanggal</th>
                        <th class="px-6 py-4">Nama Kegiatan</th>
                        <th class="px-6 py-4">Pelaksana / Institusi</th>
                        <th class="px-6 py-4">Kategori</th>
                        <th class="px-6 py-4">Lokasi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200 bg-white">
                    @forelse($jadwalLabs as $jadwal)
                    <tr class="hover:bg-gray-50 transition">
                        <td class="px-6 py-4 text-gray-900 font-medium whitespace-nowrap">
                            <div>📅 {{ \Carbon\Carbon::parse($jadwal->tanggal)->translatedFormat('d M Y') }}</div>
                            <div class="text-xs text-gray-400 mt-0.5">🕒 {{ substr($jadwal->waktu_mulai, 0, 5) }} - {{ substr($jadwal->waktu_selesai, 0, 5) }} WIB</div>
                        </td>
                        <td class="px-6 py-4">
                            <div class="font-semibold text-gray-900">{{ $jadwal->judul }}</div>
                            <div class="text-xs text-gray-400 max-w-xs truncate">{{ $jadwal->deskripsi }}</div>
                        </td>
                        <td class="px-6 py-4 text-gray-600">
                            {{ $jadwal->user->name ?? 'Mahasiswa Lab TEL' }}
                        </td>
                        <td class="px-6 py-4">
                            <span class="inline-flex items-center rounded-md bg-blue-50 px-2 py-1 text-xs font-medium text-blue-700 uppercase border border-blue-100">
                                {{ $jadwal->kategori }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-gray-600 font-medium">
                            📍 {{ $jadwal->lokasi }}
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-10 text-center text-sm text-gray-500">
                            Belum ada jadwal penggunaan laboratorium yang disetujui untuk saat ini.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection