@extends('layouts.dosen')

@section('content')

<div class="mb-8">

  <h1 class="text-4xl font-bold text-gray-800">
    Data Mahasiswa
  </h1>

  <p class="text-gray-500 mt-2">
    Daftar mahasiswa pengguna sistem laboratorium.
  </p>

</div>

<div class="bg-white rounded-2xl shadow overflow-hidden">

  <table class="w-full table-auto">

    <thead class="bg-gray-100 text-gray-700">

      <tr>

        <th class="px-6 py-4 text-left text-sm font-semibold">
          Nama
        </th>

        <th class="px-6 py-4 text-left text-sm font-semibold">
          Email
        </th>

        <th class="px-6 py-4 text-left text-sm font-semibold">
          Jumlah Kegiatan
        </th>

      </tr>

    </thead>

    <tbody>

      @forelse($mahasiswas as $mahasiswa)

      <tr class="border-b hover:bg-gray-50">

        <td class="px-6 py-4 font-semibold">
          {{ $mahasiswa->name }}
        </td>

        <td class="px-6 py-4">
          {{ $mahasiswa->email }}
        </td>

        <td class="px-6 py-4">
          {{ $mahasiswa->kegiatans->count() }}
        </td>

      </tr>

      @empty

      <tr>

        <td colspan="3"
          class="px-6 py-6 text-center text-gray-500">

          Belum ada mahasiswa.

        </td>

      </tr>

      @endforelse

    </tbody>

  </table>

</div>

@endsection