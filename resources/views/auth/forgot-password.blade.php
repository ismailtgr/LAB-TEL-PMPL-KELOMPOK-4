<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#1F2587] px-4">
        <div class="w-full max-w-sm rounded-xl bg-white p-8 shadow-xl">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-[#1F2587]">
                    Reset Kata Sandi
                </h1>
                <p class="mt-2 text-xs text-gray-500">
                    Masukkan email akun kamu. Kami akan mengirimkan link untuk mengatur ulang kata sandi.
                </p>
            </div>

            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        placeholder="your.email@example.com"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full rounded-md bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#171C6B] focus:outline-none focus:ring-2 focus:ring-[#1F2587] focus:ring-offset-2"
                    >
                        Kirim Link Reset
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="text-xs font-medium text-[#1F2587] hover:underline"
                    >
                        Kembali ke Login
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>