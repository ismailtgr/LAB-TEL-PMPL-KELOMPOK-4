@extends('layouts.dosen')

@section('content')

<div class="mb-8">

  <h1 class="text-4xl font-bold text-gray-800">
    Monitoring Kegiatan
  </h1>

  <p class="text-gray-500 mt-2">
    Monitoring seluruh kegiatan laboratorium mahasiswa.
  </p>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

  <table class="w-full">

    <thead class="bg-gray-50 border-b">

      <tr>

        <th class="text-left px-6 py-4">
          Judul
        </th>

        <th class="text-left px-6 py-4">
          Mahasiswa
        </th>

        <th class="text-left px-6 py-4">
          Tanggal
        </th>

        <th class="text-left px-6 py-4">
          Status
        </th>

      </tr>

    </thead>

    <tbody>

      @forelse($kegiatans as $kegiatan)

      <tr class="border-b hover:bg-gray-50">

        <td class="px-6 py-4">
          <a href="{{ route('dosen.kegiatan.show', $kegiatan->id) }}"
            class="text-blue-900 font-semibold hover:underline">

            {{ $kegiatan->judul }}

          </a>
        </td>

        <td class="px-6 py-4">
          {{ $kegiatan->user->name ?? '-' }}
        </td>

        <td class="px-6 py-4">
          {{ $kegiatan->tanggal }}
        </td>

        <td class="px-6 py-4">

          @if($kegiatan->status == 'pending')

          <span
            class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">

            Pending

          </span>

          @elseif($kegiatan->status == 'disetujui')

          <span
            class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">

            Disetujui

          </span>

          @else

          <span
            class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">

            Ditolak

          </span>

          @endif

        </td>

      </tr>

      @empty

      <tr>

        <td colspan="4" class="text-center py-10 text-gray-500">

          Belum ada kegiatan.

        </td>

      </tr>

      @endforelse

    </tbody>

  </table>

</div>

@endsection