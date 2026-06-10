@extends('layouts.dosen')

@section('content')
<div class="max-w-5xl mx-auto px-4 py-8">
  <div class="mb-8 flex items-center justify-between">
    <div>
      <h1 class="text-2xl font-bold text-gray-900 tracking-tight">Unggah Dokumentasi</h1>
      <p class="text-sm text-gray-500 mt-1">Lengkapi data di bawah ini untuk menambahkan dokumentasi kegiatan laboratorium terbaru.</p>
    </div>
    <a href="{{ route('dosen.dashboard') }}" class="px-5 py-2.5 rounded-xl border border-gray-200 text-gray-600 font-medium hover:bg-gray-50 transition-colors duration-200 text-sm flex items-center gap-2">
      <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
      </svg>
      Kembali
    </a>
  </div>

  <div class="bg-white rounded-3xl border border-gray-100 shadow-xl shadow-slate-100/50 p-8">
    <form
      id="uploadForm"
      action="{{ route('dosen.dokumentasi.store') }}"
      method="POST"
      enctype="multipart/form-data"
      class="space-y-8">

      @csrf

      <div class="grid grid-cols-1 md:grid-cols-2 gap-8">

        <div class="flex flex-col">
          <div class="flex items-center justify-between mb-3">
            <label class="block text-sm font-semibold text-gray-700 tracking-wide">
              Foto Dokumentasi
            </label>
            <button type="button" id="reset-file" class="hidden text-xs font-medium text-red-600 hover:text-red-700 flex items-center gap-1" onclick="clearFile()">
              <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
              </svg>
              Hapus Foto
            </button>
          </div>

          <div id="dropzone-container" class="relative flex-1 flex flex-col items-center justify-center border-2 border-dashed border-gray-200 rounded-2xl bg-gray-50/50 hover:bg-blue-50/50 hover:border-blue-400 transition-all duration-300 group cursor-pointer p-4 min-h-[250px] overflow-hidden">

            <input
              type="file"
              name="foto"
              id="foto"
              accept="image/png, image/jpeg, image/jpg"
              required
              class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-20"
              onchange="previewImage(this)">

            <div id="state-default" class="text-center pointer-events-none space-y-3 z-10">
              <div class="mx-auto w-16 h-16 rounded-2xl bg-blue-50 text-blue-600 flex items-center justify-center group-hover:scale-110 transition-transform duration-300 shadow-inner border border-blue-100">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 002-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path>
                </svg>
              </div>
              <div class="text-sm text-gray-600">
                <span class="font-semibold text-blue-600 hover:text-blue-700">Pilih foto</span> atau seret ke sini
              </div>
              <p class="text-xs text-gray-400">PNG, JPG, JPEG (Max 2MB)</p>
            </div>

            <div id="state-preview" class="hidden absolute inset-0 w-full h-full z-10 p-2">
              <img id="image-preview" src="#" alt="Pratinjau dokumentasi" class="w-full h-full object-cover rounded-xl shadow-md border border-gray-100">
              <div class="absolute bottom-4 left-4 right-4 bg-gray-900/70 backdrop-blur-sm text-white px-3 py-1.5 rounded-lg text-xs truncate font-mono shadow-lg" id="file-name-overlay"></div>
            </div>
          </div>
          <p id="file-error" class="hidden mt-2 text-xs text-red-600 font-medium"></p>
        </div>

        <div class="space-y-6">
          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 tracking-wide">
              Kegiatan Laboratorium Terkait
            </label>
            <div class="relative">
              <select
                name="kegiatan_id"
                required
                class="w-full rounded-2xl border-gray-200 bg-gray-50/50 py-3.5 px-4 text-gray-700 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 appearance-none shadow-sm text-sm">
                <option value="" disabled selected>Pilih kegiatan praktikum/riset...</option>
                @foreach($kegiatans as $kegiatan)
                <option value="{{ $kegiatan->id }}">
                  {{ $kegiatan->judul }}
                </option>
                @endforeach
              </select>
            </div>
          </div>

          <div>
            <label class="block text-sm font-semibold text-gray-700 mb-2 tracking-wide">
              Caption Dokumentasi
            </label>
            <textarea
              name="caption"
              rows="5"
              placeholder="Berikan deskripsi singkat atau caption menarik mengenai foto kegiatan ini untuk arsip laboratorium..."
              class="w-full rounded-2xl border-gray-200 bg-gray-50/50 py-3.5 px-4 text-gray-700 placeholder-gray-400 focus:bg-white focus:border-blue-500 focus:ring-4 focus:ring-blue-500/10 transition-all duration-200 shadow-sm resize-none text-sm"></textarea>
          </div>
        </div>

      </div>

      <div class="border-t border-gray-100 pt-6 flex justify-end items-center gap-4">
        <button
          type="submit"
          class="bg-blue-600 hover:bg-blue-700 active:scale-[0.98] text-white px-8 py-3.5 rounded-2xl font-semibold shadow-lg shadow-blue-500/20 hover:shadow-blue-500/30 transition-all duration-200 text-sm flex items-center gap-2.5">
          <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12"></path>
          </svg>
          Simpan Dokumentasi
        </button>
      </div>

    </form>
  </div>
</div>

<script>
  // 1. Fungsi Utama: Menampilkan Preview Gambar
  function previewImage(input) {
    const container = document.getElementById('dropzone-container');
    const stateDefault = document.getElementById('state-default');
    const statePreview = document.getElementById('state-preview');
    const imagePreview = document.getElementById('image-preview');
    const nameOverlay = document.getElementById('file-name-overlay');
    const resetBtn = document.getElementById('reset-file');
    const errorMsg = document.getElementById('file-error');

    // Reset error state
    errorMsg.classList.add('hidden');
    errorMsg.textContent = '';
    container.classList.remove('border-red-400', 'bg-red-50/50');
    container.classList.add('border-gray-200', 'bg-gray-50/50');

    if (input.files && input.files[0]) {
      const file = input.files[0];

      // Validasi Ukuran File (Max 2MB = 2048 * 1024 bytes)
      if (file.size > 2 * 1024 * 1024) {
        errorMsg.textContent = 'Maaf, ukuran file terlalu besar. Maksimal 2MB.';
        errorMsg.classList.remove('hidden');
        container.classList.add('border-red-400', 'bg-red-50/50');
        container.classList.remove('border-gray-200', 'bg-gray-50/50');
        clearFile(); // Hapus pilihan file
        return;
      }

      // Menggunakan FileReader untuk membaca gambar asinkronus
      const reader = new FileReader();

      reader.onload = function(e) {
        // Masukkan source gambar ke elemen <img>
        imagePreview.src = e.target.result;

        // Tampilkan state preview, sembunyikan state default
        stateDefault.classList.add('hidden');
        statePreview.classList.remove('hidden');

        // Tampilkan nama file dan tombol reset
        nameOverlay.textContent = file.name;
        resetBtn.classList.remove('hidden');

        // Ubah styling container menjadi solid (tidak dashed) saat ada gambar
        container.classList.remove('border-dashed');
        container.classList.add('border-solid', 'border-gray-200');
      }

      reader.readAsDataURL(file); // Mulai membaca file sebagai Data URL
    }
  }

  // 2. Fungsi Tambahan: Menghapus/Reset File yang dipilih
  function clearFile() {
    const fileInput = document.getElementById('foto');
    const stateDefault = document.getElementById('state-default');
    const statePreview = document.getElementById('state-preview');
    const imagePreview = document.getElementById('image-preview');
    const resetBtn = document.getElementById('reset-file');
    const container = document.getElementById('dropzone-container');

    // Reset input file asli
    fileInput.value = '';

    // Kembalikan UI ke state default
    imagePreview.src = '#';
    statePreview.classList.add('hidden');
    stateDefault.classList.remove('hidden');
    resetBtn.classList.add('hidden');

    // Kembalikan styling container ke dashed
    container.classList.add('border-dashed');
    container.classList.remove('border-solid');
  }

  // 3. Fitur Bonus: Menangani Drag & Drop Visual (opsional namun bagus untuk UX)
  const dropzone = document.getElementById('dropzone-container');

  ['dragenter', 'dragover'].forEach(eventName => {
    dropzone.addEventListener(eventName, (e) => {
      e.preventDefault();
      dropzone.classList.add('border-blue-500', 'bg-blue-50');
    }, false);
  });

  ['dragleave', 'drop'].forEach(eventName => {
    dropzone.addEventListener(eventName, (e) => {
      e.preventDefault();
      dropzone.classList.remove('border-blue-500', 'bg-blue-50');
    }, false);
  });
</script>
@endsection