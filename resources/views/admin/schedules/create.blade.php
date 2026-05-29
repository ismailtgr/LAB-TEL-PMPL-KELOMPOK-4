<x-app-layout>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            Tambah Jadwal Lab
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Tambahkan kegiatan laboratorium baru.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.schedules.store') }}"
        class="mt-6 max-w-3xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
        @csrf

        <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Judul Kegiatan</label>
                <input name="title" value="{{ old('title') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('title') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Kategori</label>
                <select name="schedule_category_id" class="mt-1 w-full rounded-lg border-gray-300" required>
                    <option value="">Pilih Kategori</option>
                    @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected(old('schedule_category_id')==$category->id)>
                        {{ $category->name }}
                    </option>
                    @endforeach
                </select>
                @error('schedule_category_id')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Jumlah Mahasiswa</label>
                <input type="number" name="student_count" value="{{ old('student_count', 0) }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('student_count') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Deskripsi</label>
                <textarea name="description" rows="3" class="mt-1 w-full rounded-lg border-gray-300">{{ old('description') }}</textarea>
                @error('description') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div class="md:col-span-2">
                <label class="text-sm font-medium text-gray-700">Instruktur / Dosen</label>
                <input name="instructor" value="{{ old('instructor') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('instructor') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Tanggal</label>
                <input type="date" name="date" value="{{ old('date') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('date') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Status</label>
                <select name="status" class="mt-1 w-full rounded-lg border-gray-300" required>
                    <option value="mendatang">Mendatang</option>
                    <option value="berjalan">Berjalan</option>
                    <option value="selesai">Selesai</option>
                </select>
                @error('status') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Jam Mulai</label>
                <input type="time" name="start_time" value="{{ old('start_time') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('start_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Jam Selesai</label>
                <input type="time" name="end_time" value="{{ old('end_time') }}" class="mt-1 w-full rounded-lg border-gray-300" required>
                @error('end_time') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button
                type="submit"
                class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]">
                Simpan
            </button>

            <a
                href="{{ route('admin.schedules.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50">
                Batal
            </a>
        </div>
    </form>
</x-app-layout>