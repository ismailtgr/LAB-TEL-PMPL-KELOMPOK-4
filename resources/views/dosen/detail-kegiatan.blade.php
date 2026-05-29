@extends('layouts.dosen')

@section('content')

<div class="mb-8">

  <h1 class="text-4xl font-bold text-gray-800">
    Detail Kegiatan
  </h1>

  <p class="text-gray-500 mt-2">
    Informasi lengkap kegiatan laboratorium.
  </p>

</div>

<div class="bg-white rounded-2xl shadow p-8">

  <!-- Judul -->
  <div class="mb-8">

    <h2 class="text-3xl font-bold text-gray-800">
      {{ $kegiatan->judul }}
    </h2>

  </div>

  <!-- Informasi -->
  <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">

    <div>

      <p class="text-sm text-gray-500">
        Mahasiswa
      </p>

      <h3 class="text-lg font-semibold">
        {{ $kegiatan->creator->name ?? '-' }}
      </h3>

    </div>

    <div>

      <p class="text-sm text-gray-500">
        Tanggal
      </p>

      <h3 class="text-lg font-semibold">
        {{ $kegiatan->tanggal }}
      </h3>

    </div>

    <div>

      <p class="text-sm text-gray-500">
        Status
      </p>

      <div class="mt-2">

        @if($kegiatan->status == 'pending')

        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
          Pending
        </span>

        @elseif($kegiatan->status == 'disetujui')

        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
          Disetujui
        </span>

        @else

        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
          Ditolak
        </span>

        @endif

      </div>

    </div>

  </div>

  <!-- Deskripsi -->
  <div class="mb-8">

    <p class="text-sm text-gray-500 mb-2">
      Deskripsi Kegiatan
    </p>

    <div class="bg-gray-50 rounded-xl p-5 text-gray-700 leading-relaxed">

      {{ $kegiatan->deskripsi }}

    </div>

  </div>

  <!-- Action -->
  @if($kegiatan->status == 'pending')

  <div class="flex gap-4">

    <!-- Approve -->
    <form method="POST"
      action="{{ route('dosen.approval.approve', $kegiatan->id) }}">

      @csrf
      @method('PATCH')

      <button
        class="bg-green-600 hover:bg-green-700 text-white px-6 py-3 rounded-xl transition">

        Approve

      </button>

    </form>

    <!-- Reject -->
    <form method="POST"
      action="{{ route('dosen.approval.reject', $kegiatan->id) }}">

      @csrf
      @method('PATCH')

      <button
        class="bg-red-600 hover:bg-red-700 text-white px-6 py-3 rounded-xl transition">

        Reject

      </button>

    </form>

  </div>

  @endif

</div>

@endsection