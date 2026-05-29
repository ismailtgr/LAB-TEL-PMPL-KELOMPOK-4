<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <title>Dosen Dashboard</title>
</head>

<body class="bg-gray-100">

  <div class="min-h-screen flex">

    <!-- Sidebar -->
    <!-- Sidebar -->
    <aside class="w-64 bg-blue-900 text-white flex flex-col">

      <!-- Logo -->
      <div class="p-6">
        <h1 class="text-2xl font-bold">
          Lab TEL
        </h1>

        <p class="text-sm text-blue-200">
          FILKOM UB
        </p>
      </div>

      <!-- Menu -->
      <nav class="flex-1 px-4 space-y-2">

        <a href="{{ route('dosen.dashboard') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg bg-blue-800 hover:bg-blue-700 transition">

          Dashboard
        </a>

        <a href="{{ route('dosen.kegiatan.index') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

          Monitoring Kegiatan
        </a>

        <a href="{{ route('dosen.approval') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

          Approval Kegiatan
        </a>

        <a href="{{ route('dosen.mahasiswa') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

          Mahasiswa
        </a>

        <a href="{{ route('dosen.dokumentasi') }}"
          class="flex items-center gap-3 px-4 py-3 rounded-lg hover:bg-blue-800 transition">

          Dokumentasi
        </a>

      </nav>

      <!-- Logout -->
      <div class="p-4">

        <form method="POST" action="{{ route('logout') }}">
          @csrf

          <button
            class="w-full bg-blue-800 hover:bg-blue-700 rounded-lg px-4 py-2 text-left transition">

            Logout

          </button>

        </form>

      </div>

    </aside>

    <!-- Main -->
    <main class="flex-1 p-8">

      @yield('content')

    </main>

  </div>

</body>

</html>