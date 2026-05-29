<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-[#1F2587] px-4">
        <div class="w-full max-w-sm rounded-xl bg-white p-8 shadow-xl">
            <div class="mb-6 text-center">
                <h1 class="text-2xl font-bold text-[#1F2587]">
                    Lab TEL
                </h1>
                <p class="mt-1 text-xs text-gray-500">
                    Teknologi Pembelajaran Filkom UB
                </p>
            </div>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700">
                        Nama
                    </label>

                    <input
                        id="name"
                        type="text"
                        name="name"
                        value="{{ old('name') }}"
                        required
                        autofocus
                        autocomplete="name"
                        placeholder="Nama lengkap"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
                    />

                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email
                    </label>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        value="{{ old('email') }}"
                        required
                        autocomplete="username"
                        placeholder="your.email@example.com"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
                    />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
                    />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <div class="mt-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                        Konfirmasi Kata Sandi
                    </label>

                    <input
                        id="password_confirmation"
                        type="password"
                        name="password_confirmation"
                        required
                        autocomplete="new-password"
                        placeholder="••••••••"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]"
                    />

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full rounded-md bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#171C6B] focus:outline-none focus:ring-2 focus:ring-[#1F2587] focus:ring-offset-2"
                    >
                        Daftar
                    </button>
                </div>

                <div class="mt-4 text-center">
                    <a
                        href="{{ route('login') }}"
                        class="text-xs font-medium text-[#1F2587] hover:underline"
                    >
                        Sudah punya akun? Masuk
                    </a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>