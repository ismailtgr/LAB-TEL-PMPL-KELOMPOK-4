<x-app-layout>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            Edit Dokumentasi
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Perbarui data dokumentasi kegiatan.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.dokumentasis.update', $dokumentasi) }}"
        enctype="multipart/form-data"
        class="mt-6 max-w-3xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
    >
        @csrf
        @method('PUT')

        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700">Judul</label>
                <input
                    type="text"
                    name="judul"
                    value="{{ old('judul', $dokumentasi->judul) }}"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
                @error('judul') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Kegiatan Terkait</label>
                <select name="kegiatan_id" class="mt-1 w-full rounded-lg border-gray-300">
                    <option value="">Tidak terkait kegiatan tertentu</option>
                    @foreach ($schedules as $schedule)
                        <option value="{{ $schedule->id }}" @selected(old('kegiatan_id', $dokumentasi->kegiatan_id) == $schedule->id)>
                            {{ $schedule->title }} - {{ $schedule->date }}
                        </option>
                    @endforeach
                </select>
                @error('kegiatan_id') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea
                    name="deskripsi"
                    rows="4"
                    class="mt-1 w-full rounded-lg border-gray-300"
                >{{ old('deskripsi', $dokumentasi->deskripsi) }}</textarea>
                @error('deskripsi') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">File Saat Ini</label>
                <div class="mt-2 rounded-lg border border-gray-200 p-4 text-sm text-gray-600">
                    <a
                        href="{{ asset('storage/' . $dokumentasi->file_path) }}"
                        target="_blank"
                        class="font-medium text-[#1F2587] hover:underline"
                    >
                        {{ $dokumentasi->file_name }}
                    </a>
                </div>
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Ganti File Dokumentasi</label>
                <input
                    type="file"
                    name="file"
                    class="mt-1 w-full rounded-lg border border-gray-300 px-3 py-2"
                >
                <p class="mt-1 text-xs text-gray-500">
                    Kosongkan jika tidak ingin mengganti file.
                </p>
                @error('file') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button
                type="submit"
                class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.dokumentasis.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
            >
                Batal
            </a>
        </div>
    </form>
</x-app-layout>