<x-app-layout>
    <div>
        <h1 class="text-3xl font-semibold text-gray-900">
            Tambah User
        </h1>

        <p class="mt-2 text-sm text-gray-500">
            Tambahkan akun pengguna baru ke sistem.
        </p>
    </div>

    <form
        method="POST"
        action="{{ route('admin.users.store') }}"
        class="mt-6 max-w-2xl rounded-lg border border-gray-200 bg-white p-6 shadow-sm"
    >
        @csrf

        <div class="space-y-5">
            <div>
                <label class="text-sm font-medium text-gray-700">Nama</label>
                <input
                    type="text"
                    name="name"
                    value="{{ old('name') }}"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
                @error('name') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Email</label>
                <input
                    type="email"
                    name="email"
                    value="{{ old('email') }}"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
                @error('email') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Role</label>
                <select
                    name="role"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
                    <option value="">Pilih Role</option>
                    <option value="admin" @selected(old('role') === 'admin')>Admin</option>
                    <option value="dosen" @selected(old('role') === 'dosen')>Dosen</option>
                    <option value="mahasiswa" @selected(old('role') === 'mahasiswa')>Mahasiswa</option>
                </select>
                @error('role') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Password</label>
                <input
                    type="password"
                    name="password"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
                @error('password') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
            </div>

            <div>
                <label class="text-sm font-medium text-gray-700">Konfirmasi Password</label>
                <input
                    type="password"
                    name="password_confirmation"
                    class="mt-1 w-full rounded-lg border-gray-300"
                    required
                >
            </div>
        </div>

        <div class="mt-6 flex items-center gap-3">
            <button
                type="submit"
                class="rounded-lg bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white hover:bg-[#171C6B]"
            >
                Simpan
            </button>

            <a
                href="{{ route('admin.users.index') }}"
                class="rounded-lg border border-gray-300 px-4 py-2 text-sm font-semibold text-gray-700 hover:bg-gray-50"
            >
                Batal
            </a>
        </div>
    </form>
</x-app-layout>