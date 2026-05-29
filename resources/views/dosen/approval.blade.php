@extends('layouts.dosen')

@section('content')

<div class="min-h-screen bg-gray-100 flex">


  <!-- Main -->
  <main class="flex-1 p-8">

    <div class="mb-8">

      <h1 class="text-4xl font-bold text-gray-800">
        Approval Kegiatan
      </h1>

      <p class="text-gray-500 mt-2">
        Approve atau reject kegiatan mahasiswa.
      </p>

    </div>

    <!-- Alert -->
    @if(session('success'))

    <div class="bg-green-100 text-green-700 p-4 rounded-lg mb-6">

      {{ session('success') }}

    </div>

    @endif

    <!-- Table -->
    <div class="bg-white rounded-2xl shadow overflow-hidden">

      <table class="w-full">

        <thead class="bg-gray-100">

          <tr>

            <th class="p-4 text-left">
              Judul
            </th>

            <th class="p-4 text-left">
              Tanggal
            </th>

            <th class="p-4 text-left">
              Status
            </th>

            <th class="p-4 text-left">
              Action
            </th>

          </tr>

        </thead>

        <tbody>

          @foreach($kegiatans as $kegiatan)

          <tr class="border-t">

            <td class="p-4">
              {{ $kegiatan->judul }}
            </td>

            <td class="p-4">
              {{ $kegiatan->tanggal }}
            </td>

            <td class="p-4">

              <span class="
                                        px-3 py-1 rounded-full text-sm

                                        @if($kegiatan->status == 'disetujui')
                                            bg-green-100 text-green-700
                                        @elseif($kegiatan->status == 'ditolak')
                                            bg-red-100 text-red-700
                                        @else
                                            bg-yellow-100 text-yellow-700
                                        @endif
                                    ">

                {{ $kegiatan->status }}

              </span>

            </td>

            <td class="p-4 flex gap-2">

              <!-- Approve -->
              <form method="POST"
                action="{{ route('dosen.approval.approve', $kegiatan->id) }}">

                @csrf
                @method('PATCH')

                <button
                  class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg">

                  Approve

                </button>

              </form>

              <!-- Reject -->
              <form method="POST"
                action="{{ route('dosen.approval.reject', $kegiatan->id) }}">

                @csrf
                @method('PATCH')

                <button
                  class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg">

                  Reject

                </button>

              </form>

            </td>

          </tr>

          @endforeach

        </tbody>

      </table>

    </div>

  </main>

</div>

@endsection