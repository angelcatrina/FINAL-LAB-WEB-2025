<x-guest-layout>
    <div class="relative min-h-screen flex items-center justify-center p-4"
         style="background-image: url('{{ asset('storage/avatars/h.jpg') }}'); background-size: cover; background-position: center;">

        {{-- Overlay --}}
        <div class="absolute inset-0 bg-black bg-opacity-40 backdrop-blur-sm"></div>

        <div class="relative z-10 w-full max-w-7xl flex flex-col md:flex-row bg-transparent rounded-xl overflow-hidden shadow-2xl">

            <div class="md:w-1/2 p-10 flex flex-col justify-center text-white bg-transparent -mt-10">
                <h1 class="text-7xl font-serif font-bold italic">HindiaGallery</h1>
            </div>

            <div class="md:w-1/2 p-8 md:p-12 
                        bg-white bg-opacity-20 backdrop-blur-lg 
                        border border-white border-opacity-30 rounded-xl shadow-lg
                        transition duration-300 hover:bg-opacity-25">

                <div class="text-right text-white mb-6 text-sm">
                    <a href="{{ route('login') }}" class="hover:underline">Log In</a>
                    <span class="mx-2">/</span>
                    <a href="{{ route('register') }}" class="font-bold border-b-2 border-white">Sign Up</a>
                </div>

                <h2 class="text-4xl font-extrabold text-white mb-8">
                    Silahkan Register
                </h2>

                <x-auth-validation-errors class="mb-4 text-red-300" :errors="$errors" />

                <form method="POST" action="{{ route('register') }}" class="space-y-5">
                    @csrf

                    <div>
                        <x-input-label for="name" value="FNama Lengkap" class="text-white text-lg" />
                        <x-text-input id="name"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="text" name="name" :value="old('name')" required autofocus
                            placeholder="Masukkan Nama Anda"
                            style="-webkit-text-fill-color: #fff;" />
                    </div>

                    <div>
                        <x-input-label for="email" value="Email" class="text-white text-lg" />
                        <x-text-input id="email"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="email" name="email" :value="old('email')" required
                            placeholder="Masukkan Email Anda"
                            style="-webkit-text-fill-color: #fff;" />
                    </div>
                    <div>
                        <x-input-label for="role" value="Daftar Sebagai" class="text-white text-lg" />
                        <select 
                            id="role" name="role" required
                            class="mt-1 block w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg focus:ring-blue-400 
                                   focus:border-blue-400 placeholder-gray-300"
                            style="-webkit-text-fill-color: #fff;">
                            <option value="member" class="text-black">Member</option>
                            <option value="curator" class="text-black">Curator</option>
                        </select>
                    </div>
                    <div>
                        <x-input-label for="password" value="Password" class="text-white text-lg" />
                        <x-text-input id="password"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="password" name="password" required
                            placeholder="Minimal 8 karakter"
                            style="-webkit-text-fill-color: #fff;" />
                    </div>
                    <div>
                        <x-input-label for="password_confirmation" value="Konfirmasi Password" class="text-white text-lg" />
                        <x-text-input id="password_confirmation"
                            class="block mt-1 w-full p-3 bg-white bg-opacity-10 text-white 
                                   border border-white border-opacity-30 rounded-lg 
                                   focus:ring-blue-400 focus:border-blue-400 placeholder-gray-300"
                            type="password" name="password_confirmation" required
                            placeholder="Ulangi Password"
                            style="-webkit-text-fill-color: #fff;" />
                    </div>
                    <div class="pt-4">
                        <button type="submit"
                            class="w-full py-3 rounded-lg text-white font-bold text-lg 
                                   bg-blue-600 hover:bg-blue-700 transition duration-300 shadow-xl">
                            Register
                        </button>
                    </div>
                </form>

                <div class="mt-8 text-center text-white">
                    <p class="text-sm">
                        Already have an account?
                        <a href="{{ route('login') }}" class="font-bold underline hover:text-blue-300 transition duration-200">Log In</a>
                    </p>
                </div>

            </div>

        </div>

    </div>

</x-guest-layout>
