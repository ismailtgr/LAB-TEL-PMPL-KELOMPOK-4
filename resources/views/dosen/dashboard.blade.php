@extends('layouts.dosen')

@section('content')

<div class="min-h-screen bg-gray-100 flex">



  <!-- Main Content -->
  <main class="flex-1 p-8">

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Header -->
    <div class="mb-8">

      <h2 class="text-4xl font-bold text-gray-800">
        Dashboard Dosen
      </h2>

      @if(session('success'))
      <script>
        Swal.fire({
          icon: 'success',
          title: 'Berhasil!',
          text: '{{ session('
          success ') }}',
          confirmButtonText: 'OK'
        });
      </script>
      @endif

      <p class="text-gray-500 mt-2">
        Monitoring kegiatan laboratorium dan approval mahasiswa.
      </p>

    </div>

    <!-- Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-8">

      <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">
          Total Kegiatan
        </p>

        <h3 class="text-3xl font-bold text-blue-900 mt-2">
          {{ $totalKegiatan }}
        </h3>

      </div>

      <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">
          Pending Approval
        </p>

        <h3 class="text-3xl font-bold text-yellow-500 mt-2">
          {{ $pendingApproval }}
        </h3>

      </div>

      <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">
          Kegiatan Disetujui
        </p>

        <h3 class="text-3xl font-bold text-green-500 mt-2">
          {{ $approved }}
        </h3>

      </div>

      <div class="bg-white rounded-2xl shadow p-6">

        <p class="text-gray-500 text-sm">
          Mahasiswa Aktif
        </p>

        <h3 class="text-3xl font-bold text-purple-500 mt-2">
          {{ $mahasiswa }}
        </h3>

      </div>

    </div>

    <!-- Recent Activity -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

      <div class="p-6 border-b">

        <h3 class="text-2xl font-semibold">
          Kegiatan Menunggu Approval
        </h3>

      </div>

      <div class="divide-y">

        <!-- Item -->
        @forelse($pendingKegiatans as $kegiatan)

        <div class="p-6 flex items-center justify-between">

          <div>

            <h4 class="font-semibold text-lg">
              {{ $kegiatan->judul }}
            </h4>

            <p class="text-gray-500 text-sm mt-1">
              Oleh: {{ $kegiatan->creator->name ?? '-' }}
              •
              {{ $kegiatan->tanggal }}
            </p>

          </div>

          <span
            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

            Pending

          </span>

        </div>

        @empty

        <div class="p-6 text-gray-500 text-center">

          Tidak ada kegiatan yang menunggu approval.

        </div>

        @endforelse

      </div>

    </div>

    <div class="mt-10">

      <div class="flex items-center justify-between mb-5">

        <h2 class="text-2xl font-bold text-gray-800">
          Dokumentasi Terbaru
        </h2>

        <a
          href="{{ route('dosen.dokumentasi') }}"
          class="text-blue-600 hover:underline">

          Lihat Semua

        </a>

      </div>

      <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

        @forelse($dokumentasis as $dokumentasi)

        <div class="bg-white rounded-2xl shadow overflow-hidden">

          <img
            src="{{ asset('storage/' . $dokumentasi->file_path) }}"
            class="w-full h-44 object-cover">

          <div class="p-4">

            <h3 class="font-bold text-gray-800">
              {{ $dokumentasi->judul ?? '-' }}
            </h3>

            <p class="text-sm text-gray-500 mt-2">
              {{ $dokumentasi->deskripsi }}
            </p>

          </div>

        </div>

        @empty

        <div class="col-span-full bg-white rounded-2xl p-8 text-center text-gray-500">

          Belum ada dokumentasi.

        </div>

        @endforelse

      </div>

    </div>

  </main>

</div>



@endsection