<x-app-layout>
    <div class="flex items-start justify-between">
        <div>
            <h1 class="text-3xl font-semibold text-gray-900">
                Manajemen User
            </h1>

            <p class="mt-2 text-sm text-gray-500">
                Kelola akun pengguna, role, dan akses sistem.
            </p>
        </div>

        <a
            href="{{ route('admin.users.create') }}"
            class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]"
        >
            + Tambah User
        </a>
    </div>

    @if (session('success'))
        <div class="mt-5 rounded-lg bg-green-50 px-4 py-3 text-sm text-green-700">
            {{ session('success') }}
        </div>
    @endif

    @if (session('error'))
        <div class="mt-5 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700">
            {{ session('error') }}
        </div>
    @endif

    <form method="GET" action="{{ route('admin.users.index') }}" class="mt-6 grid grid-cols-1 gap-4 md:grid-cols-[1fr_180px_120px]">
        <input
            type="text"
            name="search"
            value="{{ request('search') }}"
            placeholder="Cari nama atau email..."
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
        >

        <select
            name="role"
            class="w-full rounded-lg border border-gray-200 bg-gray-50 px-4 py-3 text-sm text-gray-700 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
        >
            <option value="">Semua Role</option>
            <option value="admin" @selected(request('role') === 'admin')>Admin</option>
            <option value="dosen" @selected(request('role') === 'dosen')>Dosen</option>
            <option value="mahasiswa" @selected(request('role') === 'mahasiswa')>Mahasiswa</option>
        </select>

        <button
            type="submit"
            class="rounded-lg bg-[#1F2587] px-4 py-3 text-sm font-semibold text-white hover:bg-[#171C6B]"
        >
            Cari
        </button>
    </form>

    @if (request('search') || request('role'))
        <div class="mt-3 flex items-center justify-between">
            <p class="text-sm text-gray-500">
                Menampilkan {{ $users->count() }} hasil.
            </p>

            <a
                href="{{ route('admin.users.index') }}"
                class="text-sm font-medium text-[#1F2587] hover:underline"
            >
                Reset filter
            </a>
        </div>
    @endif

    <div class="mt-6 overflow-hidden rounded-lg border border-gray-200 bg-white shadow-sm">
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-xs uppercase text-gray-500">
                <tr>
                    <th class="px-6 py-4">Nama</th>
                    <th class="px-6 py-4">Email</th>
                    <th class="px-6 py-4">Role</th>
                    <th class="px-6 py-4">Dibuat</th>
                    <th class="px-6 py-4 text-right">Aksi</th>
                </tr>
            </thead>

            <tbody class="divide-y divide-gray-200">
                @forelse ($users as $user)
                    <tr>
                        <td class="px-6 py-4 font-medium text-gray-900">
                            {{ $user->name }}
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->email }}
                        </td>

                        <td class="px-6 py-4">
                            <span class="rounded-full px-3 py-1 text-xs font-semibold
                                @if ($user->role === 'admin') bg-red-100 text-red-700
                                @elseif ($user->role === 'dosen') bg-blue-100 text-blue-700
                                @else bg-green-100 text-green-700
                                @endif
                            ">
                                {{ ucfirst($user->role) }}
                            </span>
                        </td>

                        <td class="px-6 py-4 text-gray-500">
                            {{ $user->created_at?->format('Y-m-d') }}
                        </td>

                        <td class="px-6 py-4">
                            <div class="flex justify-end gap-2">
                                <a
                                    href="{{ route('admin.users.edit', $user) }}"
                                    class="rounded-md border border-gray-200 px-3 py-2 text-xs font-semibold text-gray-700 hover:bg-gray-50"
                                >
                                    Edit
                                </a>

                                <form
                                    method="POST"
                                    action="{{ route('admin.users.destroy', $user) }}"
                                    onsubmit="return confirm('Yakin ingin menghapus user ini?')"
                                >
                                    @csrf
                                    @method('DELETE')

                                    <button
                                        type="submit"
                                        class="rounded-md bg-red-50 px-3 py-2 text-xs font-semibold text-red-600 hover:bg-red-100"
                                    >
                                        Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                            Belum ada user.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</x-app-layout>