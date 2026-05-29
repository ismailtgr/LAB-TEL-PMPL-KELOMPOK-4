<x-app-layout>
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Dokumentasi
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola dokumentasi kegiatan berupa foto, video, atau dokumen.
            </p>
        </div>

        <a
            href="{{ route('admin.dokumentasis.create') }}"
            class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]">
            + Upload Dokumentasi
        </a>
    </div>

    @if (session('success'))
    <div class="mt-5 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
        {{ session('success') }}
    </div>
    @endif

    <form method="GET" action="{{ route('admin.dokumentasis.index') }}" class="mt-6 grid grid-cols-1 gap-4 lg:grid-cols-[1fr_180px_240px_120px]">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari judul, deskripsi, atau nama file..."
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]">

        <select
            name="file_type"
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]">
            <option value="">Semua Tipe</option>
            <option value="image" @selected(request('file_type')==='image' )>Foto</option>
            <option value="video" @selected(request('file_type')==='video' )>Video</option>
            <option value="document" @selected(request('file_type')==='document' )>Dokumen</option>
            <option value="other" @selected(request('file_type')==='other' )>Lainnya</option>
        </select>

        <select
            name="kegiatan_id"
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]">
            <option value="">Semua Kegiatan</option>
            @foreach ($schedules as $schedule)
            <option value="{{ $schedule->id }}" @selected(request('kegiatan_id')==$schedule->id)>
                {{ $schedule->title }} - {{ $schedule->date }}
            </option>
            @endforeach
        </select>

        <button
            type="submit"
            class="rounded-lg bg-[#1F2587] px-4 py-3 text-sm font-semibold text-white hover:bg-[#171C6B]">
            Cari
        </button>
    </form>

    @if (request('search') || request('file_type') || request('kegiatan_id'))
    <div class="mt-3 flex items-center justify-between">
        <p class="text-sm text-gray-500">
            Menampilkan {{ $dokumentasis->count() }} hasil.
        </p>

        <a
            href="{{ route('admin.dokumentasis.index') }}"
            class="text-sm font-medium text-[#1F2587] hover:underline">
            Reset filter
        </a>
    </div>
    @endif

    <div class="mt-6 grid grid-cols-1 gap-5 lg:grid-cols-3">
        @forelse ($dokumentasis as $dokumentasi)
        <div class="overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
            <div class="flex h-48 items-center justify-center bg-gray-100">
                @if ($dokumentasi->file_type === 'image')
                <img
                    src="{{ asset('storage/' . $dokumentasi->file_path) }}"
                    alt="{{ $dokumentasi->judul }}"
                    class="h-full w-full object-cover">
                @elseif ($dokumentasi->file_type === 'video')
                <video
                    src="{{ asset('storage/' . $dokumentasi->file_path) }}"
                    class="h-full w-full object-cover"
                    controls></video>
                @else
                <div class="text-center text-sm text-gray-500">
                    <div class="text-4xl">📄</div>
                    <p class="mt-2">{{ $dokumentasi->file_name }}</p>
                </div>
                @endif
            </div>

            <div class="p-5">
                <div class="flex items-start justify-between gap-3">
                    <h2 class="font-semibold text-gray-900">
                        {{ $dokumentasi->judul }}
                    </h2>

                    <span class="rounded-full bg-indigo-100 px-3 py-1 text-xs font-medium text-[#1F2587]">
                        {{ $dokumentasi->file_type }}
                    </span>
                </div>

                <p class="mt-2 text-sm text-gray-500">
                    {{ $dokumentasi->deskripsi ?? 'Tidak ada deskripsi.' }}
                </p>

                <div class="mt-4 text-xs text-gray-500">
                    <p>Kegiatan: {{ $dokumentasi->kegiatan?->title ?? '-' }}</p>
                    <p>Uploader: {{ $dokumentasi->uploader?->name ?? '-' }}</p>
                </div>

                <div class="mt-5 flex flex-wrap gap-2">
                    <a
                        href="{{ asset('storage/' . $dokumentasi->file_path) }}"
                        target="_blank"
                        class="rounded-md border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                        Lihat
                    </a>

                    <a
                        href="{{ route('admin.dokumentasis.edit', $dokumentasi) }}"
                        class="rounded-md border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50">
                        Edit
                    </a>

                    <form
                        method="POST"
                        action="{{ route('admin.dokumentasis.destroy', $dokumentasi) }}"
                        onsubmit="return confirm('Yakin ingin menghapus dokumentasi ini?')">
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
        </div>
        @empty
        <div class="col-span-full rounded-lg border border-dashed border-gray-300 bg-white p-8 text-center text-sm text-gray-500">
            Belum ada dokumentasi.
        </div>
        @endforelse
    </div>
</x-app-layout>