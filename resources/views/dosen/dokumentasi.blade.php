@extends('layouts.dosen')

@section('content')

<div class="bg-white rounded-2xl shadow p-6 mb-8">

  <form
    action="{{ route('dosen.dokumentasi.store') }}"
    method="POST"
    enctype="multipart/form-data">

    @csrf

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

      <div>

        <label class="block text-sm font-medium mb-2">
          Pilih Kegiatan
        </label>

        <select
          name="kegiatan_id"
          class="w-full rounded-xl border-gray-300">

          @foreach($kegiatans as $kegiatan)

          <option value="{{ $kegiatan->id }}">

            {{ $kegiatan->judul }}

          </option>

          @endforeach

        </select>

      </div>

      <div>

        <label class="block text-sm font-medium mb-2">
          Upload Foto
        </label>

        <input
          type="file"
          name="foto"
          class="w-full rounded-xl border-gray-300">

      </div>

      <div>

        <label class="block text-sm font-medium mb-2">
          Caption
        </label>

        <input
          type="text"
          name="caption"
          placeholder="Masukkan caption"
          class="w-full rounded-xl border-gray-300">

      </div>

    </div>

    <button
      type="submit"
      class="mt-5 bg-blue-700 hover:bg-blue-800 text-white px-6 py-3 rounded-xl">

      Upload Dokumentasi

    </button>

  </form>

</div>

@endsection