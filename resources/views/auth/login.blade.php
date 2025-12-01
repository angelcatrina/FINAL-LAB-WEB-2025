<x-guest-layout>

    <div class="relative min-h-screen flex items-center justify-center p-4" 
         style="background-image: url('{{ asset('storage/avatars/h.jpg') }}'); background-size: cover; background-position: center;">
        
        <div class="absolute inset-0 bg-black bg-opacity-40 backdrop-blur-sm"></div>

        
        <div class="relative z-10 w-full **max-w-7xl** flex flex-col md:flex-row bg-transparent rounded-xl overflow-hidden shadow-2xl">

          <div class="md:w-1/2 p-10 flex flex-col justify-center text-white bg-transparent -mt-10">
    <h1 class="text-7xl font-serif font-bold italic">HindiaGallery</h1>
    <p class="mt-2 text-sm font-light italic">By: Angel Catrina Sobbu</p>
</div>

            <div class="md:w-1/2 p-8 md:p-12 
                        bg-white bg-opacity-20 backdrop-blur-lg 
                        border border-white border-opacity-30 rounded-xl shadow-lg
                        transition duration-300 hover:bg-opacity-25">
                
                <div class="text-right text-white mb-6 text-sm">
                    <a href="{{ route('login') }}" class="font-bold border-b-2 border-transparent hover:border-white transition duration-200">Log In</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('register') }}" class="hover:underline">Sign Up</a>
                </div>

                <h2 class="text-4xl font-extrabold text-white mb-8">
                     Login!
                </h2>

                <x-auth-session-status class="mb-4 text-white" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <x-input-label for="email" value="Email" class="text-white text-lg" />
                        <x-text-input id="email"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="email"
                            name="email"
                            :value="old('email')" 
                            required 
                            autofocus 
                            autocomplete="username" 
                            placeholder="Masukkan Email Anda"
                            style="
                                -webkit-text-fill-color: #fff;
                                -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.1) inset;
                                transition: background-color 5000s ease-in-out 0s;
                            "
                        />
                        <x-input-error :messages="$errors->get('email')" class="mt-2 text-red-300" />
                    </div>

                    <div class="mb-6">
                        <x-input-label for="password" value="Password" class="text-white text-lg" />
                        <x-text-input id="password"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="password"
                            name="password"
                            required 
                            autocomplete="current-password"
                            placeholder="Masukkan Password Anda"
                            style="
                                -webkit-text-fill-color: #fff;
                                -webkit-box-shadow: 0 0 0px 1000px rgba(255, 255, 255, 0.1) inset;
                                transition: background-color 5000s ease-in-out 0s;
                            "
                        />
                        <x-input-error :messages="$errors->get('password')" class="mt-2 text-red-300" />
                    </div>

                    <div class="flex items-center justify-between mt-6">
                        
                        @if (Route::has('password.request'))
                            <a class="text-sm text-white hover:text-blue-200 transition duration-200"
                                href="{{ route('password.request') }}">
                                Forgot your password?
                            </a>
                        @endif

                        {{-- Login Button --}}
                        <button type="submit"
                            class="ms-4 px-8 py-3 rounded-lg text-white font-bold text-lg 
                                   bg-blue-600 hover:bg-blue-700 
                                   transition duration-300 shadow-xl">
                            Log In
                        </button>
                    </div>
                </form>

                {{-- Sign Up Link --}}
                <div class="mt-8 text-center text-white">
                    <p class="text-sm">
                        Don't have an account? 
                        <a href="{{ route('register') }}" class="font-bold underline hover:text-blue-300 transition duration-200">Sign up</a>
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-guest-layout>