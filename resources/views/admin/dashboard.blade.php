<x-app-layout>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            Selamat Datang Kembali!
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Berikut yang terjadi di laboratorium Anda hari ini.
        </p>
    </div>

    <!-- Statistic Cards -->
    <div class="mt-7 grid grid-cols-1 gap-5 sm:grid-cols-2 xl:grid-cols-4">
        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Lab Aktif</p>
            <p class="mt-3 text-3xl font-semibold text-[#1F2587]">
                {{ $labAktif }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Dokumen</p>
            <p class="mt-3 text-3xl font-semibold text-green-500">
                {{ $dokumen }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Mahasiswa</p>
            <p class="mt-3 text-3xl font-semibold text-yellow-500">
                {{ $mahasiswa }}
            </p>
        </div>

        <div class="rounded-lg border border-gray-200 bg-white p-6 shadow-sm">
            <p class="text-sm text-gray-500">Penyelesaian</p>
            <p class="mt-3 text-3xl font-semibold text-[#1F2587]">
                {{ $penyelesaian }}%
            </p>
        </div>
    </div>

    <!-- Upcoming Activities -->
    <section class="mt-7 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <div class="border-b border-gray-200 px-6 py-5">
            <h2 class="text-lg font-semibold text-gray-900">
                Kegiatan Lab Mendatang
            </h2>
        </div>

        <div class="divide-y divide-gray-200">
            @forelse ($upcomingSchedules as $schedule)
                <div class="px-6 py-5">
                    <div class="flex items-center gap-3">
                        <h3 class="font-semibold text-gray-900">
                            {{ $schedule->title }}
                        </h3>

                        <span class="rounded-full bg-yellow-100 px-3 py-1 text-xs font-medium text-yellow-700">
                            {{ $schedule->status }}
                        </span>
                    </div>

                    <p class="mt-2 text-sm text-gray-500">
                        {{ $schedule->category?->name ?? '-' }} • {{ $schedule->instructor }}
                    </p>

                    <div class="mt-3 flex items-center gap-6 text-sm text-gray-500">
                        <span>📅 {{ $schedule->date }}</span>
                        <span>🕘 {{ substr($schedule->start_time, 0, 5) }} WIB</span>
                    </div>
                </div>
            @empty
                <div class="px-6 py-8 text-center text-sm text-gray-500">
                    Belum ada kegiatan lab mendatang.
                </div>
            @endforelse
        </div>
    </section>
</x-app-layout>