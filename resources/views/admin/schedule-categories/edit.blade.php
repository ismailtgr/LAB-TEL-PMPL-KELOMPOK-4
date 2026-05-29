<x-app-layout>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            Edit Kategori Jadwal
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Perbarui kategori jadwal laboratorium.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.schedule-categories.update', $scheduleCategory) }}"
        class="mt-6 max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
    >
        @csrf
        @method('PUT')

        <div>
            <label for="name" class="text-sm font-medium text-gray-700">
                Nama Kategori
            </label>

            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name', $scheduleCategory->name) }}"
                required
                class="mt-1 w-full rounded-lg border-gray-300"
            >

            @error('name')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-5">
            <label for="description" class="text-sm font-medium text-gray-700">
                Deskripsi
            </label>

            <textarea
                id="description"
                name="description"
                rows="4"
                class="mt-1 w-full rounded-lg border-gray-300"
            >{{ old('description', $scheduleCategory->description) }}</textarea>

            @error('description')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button
                type="submit"
                class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]"
            >
                Simpan Perubahan
            </button>

            <a
                href="{{ route('admin.schedule-categories.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
            >
                Batal
            </a>
        </div>
    </form>
</x-app-layout>