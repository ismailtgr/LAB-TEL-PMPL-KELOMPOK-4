<x-app-layout>
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Jadwal Laboratorium
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Telusuri dan kelola kegiatan serta jadwal laboratorium.
            </p>
        </div>

        <a
            href="{{ route('admin.schedules.create') }}"
            class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]">
            + Tambah Jadwal
        </a>
    </div>

    @if (session('success'))
    <div class="mt-5 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.schedules.index') }}" class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px_120px]">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari kegiatan atau instruktur..."
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]">

        <select
            name="category"
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]">
            <option value="">Semua Kategori</option>
            @foreach ($categories as $item)
            <option value="{{ $item->id }}" @selected(request('category')==$item->id)>
                {{ $item->name }}
            </option>
            @endforeach
        </select>

        <button
            type="submit"
            class="rounded-lg bg-[#1F2587] px-4 py-3 text-sm font-semibold text-white hover:bg-[#171C6B]">
            Cari
        </button>
    </form>

    @if (request('search') || request('category'))
    <div class="mt-3">
        <a
            href="{{ route('admin.schedules.index') }}"
            class="text-sm font-medium text-[#1F2587] hover:underline">
            Reset filter
        </a>
    </div>
    @endif

    @if (request('search') || request('category'))
    <p class="mt-5 text-sm text-gray-500">
        Menampilkan {{ $schedules->count() }} hasil
        @if (request('search'))
        untuk pencarian "{{ request('search') }}"
        @endif
        @if (request('category'))
        dengan kategori "{{ request('category') }}"
        @endif
        .
    </p>
    @endif

    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-2">
        @forelse ($schedules as $schedule)
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm transition hover:shadow-md">
            <div class="flex items-start justify-between">
                <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-[#1F2587]">
                    {{ $schedule->category?->name ?? '-' }}
                </span>

                <span class="text-sm text-gray-500">
                    {{ $schedule->student_count }} mahasiswa
                </span>
            </div>

            <h2 class="mt-5 text-lg font-semibold text-[#1F2587]">
                {{ $schedule->title }}
            </h2>

            <p class="mt-3 text-sm text-gray-500">
                {{ $schedule->description }}
            </p>

            <div class="mt-5 space-y-2 text-sm text-gray-500">
                <div class="flex items-center gap-3">
                    <span>👤</span>
                    <span>{{ $schedule->instructor }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <span>📅</span>
                    <span>{{ $schedule->date }}</span>
                </div>

                <div class="flex items-center gap-3">
                    <span>🕘</span>
                    <span>{{ substr($schedule->start_time, 0, 5) }} - {{ substr($schedule->end_time, 0, 5) }} WIB</span>
                </div>
            </div>

            <div class="mt-5 flex items-center gap-3">
                <a
                    href="{{ route('admin.schedules.edit', $schedule) }}"
                    class="rounded-md border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                    Edit
                </a>

                <form
                    method="POST"
                    action="{{ route('admin.schedules.destroy', $schedule) }}"
                    onsubmit="return confirm('Yakin ingin menghapus jadwal ini?')">
                    @csrf
                    @method('DELETE')

                    <button
                        type="submit"
                        class="rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-100">
                        Hapus
                    </button>
                </form>
            </div>
        </div>
        @empty
        <div class="col-span-full rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center text-sm text-gray-500">
            Belum ada jadwal laboratorium.
        </div>
        @endforelse
    </div>
</x-app-layout>