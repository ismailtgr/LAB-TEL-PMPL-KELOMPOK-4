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

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
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
                        autocomplete="username"
                        placeholder="your.email@example.com"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]" />

                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">
                        Kata Sandi
                    </label>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        required
                        autocomplete="current-password"
                        placeholder="••••••••"
                        class="mt-1 block w-full rounded-md border border-gray-300 bg-gray-50 px-3 py-2 text-sm text-gray-900 shadow-sm placeholder:text-gray-400 focus:border-[#1F2587] focus:outline-none focus:ring-1 focus:ring-[#1F2587]" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="mt-4 flex items-center">
                    <input
                        id="remember_me"
                        type="checkbox"
                        name="remember"
                        class="rounded border-gray-300 text-[#1F2587] shadow-sm focus:ring-[#1F2587]">

                    <label for="remember_me" class="ms-2 text-sm text-gray-600">
                        Ingat saya
                    </label>
                </div>

                <div class="mt-6">
                    <button
                        type="submit"
                        class="w-full rounded-md bg-[#1F2587] px-4 py-2 text-sm font-semibold text-white shadow-sm transition hover:bg-[#171C6B] focus:outline-none focus:ring-2 focus:ring-[#1F2587] focus:ring-offset-2">
                        Masuk
                    </button>
                </div>

                <div class="mt-4 text-center">
                    @if (Route::has('password.request'))
                    <a
                        href="{{ route('password.request') }}"
                        class="text-xs font-medium text-[#1F2587] hover:underline">
                        Lupa Kata Sandi?
                    </a>
                    @endif

                    @if (Route::has('register'))
                    <p class="mt-3 text-xs text-gray-600">
                        Belum punya akun?
                        <a
                            href="{{ route('register') }}"
                            class="font-semibold text-[#1F2587] hover:underline">
                            Daftar di sini
                        </a>
                    </p>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>