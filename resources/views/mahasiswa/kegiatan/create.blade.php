@extends('layouts.mahasiswa')

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    <div>
        <a href="{{ route('mahasiswa.kegiatan.index') }}" class="text-sm font-medium text-[#1F2587] hover:underline">
            ← Kembali ke Daftar
        </a>
        <h1 class="text-3xl font-semibold text-gray-900 mt-2">Formulir Pengajuan Kegiatan</h1>
        <p class="mt-1 text-sm text-gray-500">Isi detail rencana kegiatan laboratorium Anda dengan lengkap.</p>
    </div>

    <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        <form action="{{ route('mahasiswa.kegiatan.store') }}" method="POST" class="space-y-5">
            @csrf

            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700">Judul Kegiatan</label>
                <input type="text" name="judul" id="judul" value="{{ old('judul') }}"
                       class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('judul') border-red-500 @enderror" 
                       placeholder="Contoh: Penelitian Tugas Akhir Akurasi Sensor">
                @error('judul') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-2">
                <div>
                    <label for="kategori" class="block text-sm font-medium text-gray-700">Kategori Kegiatan</label>
                    <select name="kategori" id="kategori" 
                            class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('kategori') border-red-500 @enderror">
                        <option value="">-- Pilih Kategori --</option>
                        <option value="penelitian" {{ old('kategori') == 'penelitian' ? 'selected' : '' }}>Penelitian / TA</option>
                        <option value="workshop" {{ old('kategori') == 'workshop' ? 'selected' : '' }}>Workshop / Pelatihan</option>
                        <option value="praktikum" {{ old('kategori') == 'praktikum' ? 'selected' : '' }}>Praktikum Mandiri</option>
                        <option value="lainnya" {{ old('kategori') == 'lainnya' ? 'selected' : '' }}>Lainnya</option>
                    </select>
                    @error('kategori') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="lokasi" class="block text-sm font-medium text-gray-700">Lokasi / Ruang Lab</label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('lokasi') border-red-500 @enderror" 
                           placeholder="Contoh: Ruang Lab TEL Utama">
                    @error('lokasi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi Detail Kegiatan</label>
                <textarea name="deskripsi" id="deskripsi" rows="4"
                          class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('deskripsi') border-red-500 @enderror" 
                          placeholder="Jelaskan secara ringkas tujuan penggunaan lab beserta alat-alat yang akan digunakan...">{{ old('deskripsi') }}</textarea>
                @error('deskripsi') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
            </div>

            <div class="grid grid-cols-1 gap-5 sm:grid-cols-3">
                <div>
                    <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal Pelaksanaan</label>
                    <input type="date" name="tanggal" id="tanggal" value="{{ old('tanggal') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('tanggal') border-red-500 @enderror">
                    @error('tanggal') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" value="{{ old('waktu_mulai') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('waktu_mulai') border-red-500 @enderror">
                    @error('waktu_mulai') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>

                <div>
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" value="{{ old('waktu_selesai') }}"
                           class="mt-1 block w-full rounded-md border-gray-300 p-2.5 border text-sm shadow-sm focus:border-[#1F2587] focus:ring-[#1F2587] @error('waktu_selesai') border-red-500 @enderror">
                    @error('waktu_selesai') <p class="mt-1 text-xs text-red-500">{{ $message }}</p> @enderror
                </div>
            </div>

            <div class="flex justify-end gap-3 pt-4 border-t border-gray-100">
                <a href="{{ route('mahasiswa.kegiatan.index') }}" 
                   class="rounded-md border border-gray-300 bg-white px-4 py-2 text-sm font-medium text-gray-700 shadow-sm hover:bg-gray-50 transition">
                    Batal
                </a>
                <button type="submit" 
                        class="rounded-md bg-[#1F2587] px-4 py-2 text-sm font-medium text-white shadow-sm hover:bg-[#15195c] transition">
                    Kirim Pengajuan
                </button>
            </div>
        </form>
    </div>
</div>
@endsection