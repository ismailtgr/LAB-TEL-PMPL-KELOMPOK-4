<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Lab Tel Filkom UB') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">
    @php
        $userRole = auth()->user()->role ?? null;

        $dashboardRoute = match ($userRole) {
            'admin' => 'admin.dashboard',
            'dosen' => 'dosen.dashboard',
            'mahasiswa' => 'mahasiswa.dashboard',
            default => 'login',
        };
    @endphp

    <div class="min-h-screen flex bg-white">
        <!-- Sidebar -->
        <aside class="fixed left-0 top-0 flex h-screen w-60 flex-col bg-[#1F2587] text-white">
            <div class="px-6 py-7">
                <h1 class="text-xl font-semibold leading-tight">Lab TEL</h1>
                <p class="mt-1 text-xs text-white/70">FILKOM UB</p>
            </div>

            <nav class="mt-4 flex-1 space-y-2 px-4">
                <!-- Dashboard -->
                <a
                    href="{{ route($dashboardRoute) }}"
                    class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                    {{ request()->routeIs($dashboardRoute)
                        ? 'bg-white/20 text-white'
                        : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                >
                    <span>▣</span>
                    <span>Dashboard</span>
                </a>

                <!-- Admin Menu -->
                @if ($userRole === 'admin')
                    <a
                        href="{{ route('admin.schedule-categories.index') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('admin.schedule-categories.*')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▤</span>
                        <span>Kategori Jadwal</span>
                    </a>

                    <a
                        href="{{ route('admin.schedules.index') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('admin.schedules.*')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▦</span>
                        <span>Jadwal Lab</span>
                    </a>

                    <a
                        href="{{ route('admin.dokumentasis.index') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('admin.dokumentasis.*')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▧</span>
                        <span>Upload Dokumen</span>
                    </a>

                    <a
                        href="{{ route('admin.users.index') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('admin.users.*')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▥</span>
                        <span>Manajemen User</span>
                    </a>
                @endif

                <!-- Dosen Menu -->
                @if ($userRole === 'dosen')
                    <a
                        href="{{ route('dosen.dashboard') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.dashboard')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▦</span>
                        <span>Dashboard Dosen</span>
                    </a>
                @endif

                <!-- Mahasiswa Menu -->
                @if ($userRole === 'mahasiswa')
                    <a
                        href="{{ route('mahasiswa.dashboard') }}"
                        class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('mahasiswa.dashboard')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}"
                    >
                        <span>▦</span>
                        <span>Dashboard Mahasiswa</span>
                    </a>
                @endif
            </nav>

            <div class="px-4 pb-6">
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <button
                        type="submit"
                        class="flex w-full items-center gap-3 rounded-md px-4 py-3 text-sm font-medium text-white/80 transition hover:bg-white/10 hover:text-white"
                    >
                        <span>■</span>
                        <span>Logout</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- Main Content -->
        <main class="ml-60 min-h-screen flex-1 bg-white px-8 py-8">
            {{ $slot }}
        </main>
    </div>
</body>

</html>