<x-guest-layout>

    <!-- <div class="min-h-screen flex flex-col justify-center items-center
                bg-gray-200">  ABU ABU POLOS -->

        <!-- CARD LOGIN -->
        <div class="w-full max-w-md bg-white shadow-xl
                    border border-gray-200 rounded-2xl p-8">

            <!-- Judul -->
            <h1 class="text-3xl font-bold text-center text-gray-800 mb-6">
                SELAMAT DATANG!
            </h1>

            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <!-- Email Address -->
                <div>
                    <x-input-label for="email" :value="__('Email')" class="text-gray-700" />
                    <x-text-input id="email"
                        class="block mt-1 w-full border-gray-300 rounded-lg
                               focus:border-gray-500 focus:ring-gray-300"
                        type="email"
                        name="email"
                        :value="old('email')" required autofocus autocomplete="username" />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" class="text-gray-700" />

                    <x-text-input id="password"
                        class="block mt-1 w-full border-gray-300 rounded-lg
                               focus:border-gray-500 focus:ring-gray-300"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Remember Me -->
                <div class="block mt-4">
                    <label for="remember_me" class="inline-flex items-center">
                        <input id="remember_me" type="checkbox"
                            class="rounded border-gray-300 text-gray-600 shadow-sm
                                   focus:ring-gray-400"
                            name="remember">
                        <span class="ms-2 text-sm text-gray-700">Remember me</span>
                    </label>
                </div>

                <div class="flex items-center justify-between mt-6">

                    @if (Route::has('password.request'))
                        <a class="underline text-sm text-gray-600 hover:text-gray-900"
                            href="{{ route('password.request') }}">
                            Forgot your password?
                        </a>
                    @endif

                    <button type="submit"
                        class="px-5 py-2 rounded-lg text-white font-semibold shadow
                               bg-gray-600 hover:bg-gray-700
                               transition duration-200">
                        Log in
                    </button>
                </div>

            </form>
        </div>
    </div>

</x-guest-layout>
