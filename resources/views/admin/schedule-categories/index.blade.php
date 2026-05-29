<x-app-layout>
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Kategori Jadwal
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola kategori untuk jadwal laboratorium.
            </p>
        </div>

        <a
            href="{{ route('admin.schedule-categories.create') }}"
            class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]"
        >
            + Tambah Kategori
        </a>
    </div>

    @if (session('success'))
        <div class="mt-5 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-6 py-4">Nama Kategori</th>
                    <th class="px-6 py-4">Deskripsi</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($categories as $category)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $category->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $category->description ?? '-' }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a
                                    href="{{ route('admin.schedule-categories.edit', $category) }}"
                                    class="rounded-md border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.schedule-categories.destroy', $category) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus kategori ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-100"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="px-6 py-8 text-center text-gray-500">
                            Belum ada kategori jadwal.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>