<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <title>Dosen Dashboard - {{ config('app.name', 'Lab Tel') }}</title>

  <link rel="preconnect" href="https://fonts.bunny.net">
  <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700&display=swap" rel="stylesheet" />

  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="font-sans antialiased bg-gray-100">

  <div class="min-h-screen flex bg-white">
    <aside class="fixed left-0 top-0 flex h-screen w-60 flex-col bg-[#1F2587] text-white">
      <div class="px-6 py-7">
        <h1 class="text-xl font-semibold leading-tight">Lab TEL</h1>
        <p class="mt-1 text-xs text-white/70">FILKOM UB</p>
      </div>

      <nav class="mt-2 flex-1 space-y-2 px-4">
        <a
          href="{{ route('dosen.dashboard') }}"
          class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.dashboard')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
          <span>▣</span>
          <span>Dashboard</span>
        </a>

        <a
          href="{{ route('dosen.monitoring') }}"
          class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.monitoring')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
          <span>📊</span>
          <span>Monitoring Kegiatan</span>
        </a>

        <a
          href="{{ route('dosen.approval') }}"
          class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.approval')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
          <span>✅</span>
          <span>Approval Kegiatan</span>
        </a>

        <a
          href="{{ route('dosen.mahasiswa') }}"
          class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.mahasiswa')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
          <span>👥</span>
          <span>Mahasiswa</span>
        </a>

        <a
          href="{{ route('dosen.dokumentasi') }}"
          class="flex items-center gap-3 rounded-md px-4 py-3 text-sm font-medium transition
                        {{ request()->routeIs('dosen.dokumentasi')
                            ? 'bg-white/20 text-white'
                            : 'text-white/80 hover:bg-white/10 hover:text-white' }}">
          <span>📂</span>
          <span>Dokumentasi</span>
        </a>
      </nav>

      <div class="px-4 pb-6 border-t border-white/10 pt-4">
        <div class="px-4 pb-3">
          <p class="text-sm font-medium truncate">{{ Auth::user()->name }}</p>
          <p class="text-xs text-white/60 truncate">{{ Auth::user()->email }}</p>
        </div>

        <form method="POST" action="{{ route('logout') }}">
          @csrf
          <button
            type="submit"
            class="flex w-full items-center gap-3 rounded-md px-4 py-2.5 text-sm font-medium text-red-300 transition hover:bg-red-500/20 hover:text-red-200">
            <span>■</span>
            <span>Logout</span>
          </button>
        </form>
      </div>
    </aside>

    <main class="ml-60 min-h-screen flex-1 bg-white px-8 py-8">
      @yield('content')
    </main>
  </div>
</body>

</html>