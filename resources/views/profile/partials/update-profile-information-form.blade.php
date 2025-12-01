<section class="max-w-3xl mx-auto py-10 px-6">
    <header class="mb-8 text-center">
        <h2 class="text-3xl font-bold text-gray-900">
            
        </h2>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-8" enctype="multipart/form-data">
        @csrf
        @method('patch')

        <div class="flex flex-col items-center">
            <label for="avatar" class="cursor-pointer group relative">
                @if($user->avatar_path)
                    <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar_path) }}" alt="Avatar"
                         class="w-32 h-32 rounded-full object-cover border-4 border-indigo-200 shadow-lg transition-transform duration-200 group-hover:scale-105">
                @else
                    <div id="avatarPreview"
                         class="w-32 h-32 bg-gradient-to-br from-purple-500 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-4xl border-4 border-indigo-200 shadow-lg transition-transform duration-200 group-hover:scale-105">
                        {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
                    </div>
                @endif
                <div class="absolute inset-0 rounded-full bg-black bg-opacity-20 opacity-0 group-hover:opacity-100 flex items-center justify-center text-white text-sm font-semibold transition-opacity duration-200">
                    Ganti Foto
                </div>
            </label>
            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(event)">
            <p class="text-sm text-gray-500 mt-2">Klik gambar untuk mengganti foto profil</p>
        </div>

        <div>
            <x-input-label for="display_name" :value="__('Display Name')" />
            <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                          :value="old('display_name', $user->display_name)" autocomplete="display_name" />
            <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
        </div>

      
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                          :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                          :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2">
                    <p class="text-sm text-gray-700">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-indigo-600 hover:text-indigo-800 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            {{ __('Click here to re-send the verification email.') }}
                        </button>
                    </p>

                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-2 font-medium text-sm text-green-600">
                            {{ __('A new verification link has been sent to your email address.') }}
                        </p>
                    @endif
                </div>
            @endif
        </div>

        {{-- Bio --}}
        <div>
            <x-input-label for="bio" :value="__('Bio / Deskripsi Singkat')" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" placeholder="Tulis sedikit tentang dirimu...">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        <div class="grid grid-cols-1 gap-6 md:grid-cols-3">
            <div>
                <x-input-label for="instagram_url" :value="__('Instagram')" />
                <x-text-input id="instagram_url" name="instagram_url" type="url" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                              :value="old('instagram_url', $user->instagram_url)" placeholder="https://instagram.com/username"/>
                <x-input-error class="mt-2" :messages="$errors->get('instagram_url')" />
            </div>

            <div>
                <x-input-label for="behance_url" :value="__('Behance')" />
                <x-text-input id="behance_url" name="behance_url" type="url" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                              :value="old('behance_url', $user->behance_url)" placeholder="https://behance.net/username"/>
                <x-input-error class="mt-2" :messages="$errors->get('behance_url')" />
            </div>

            <div>
                <x-input-label for="website_url" :value="__('Website')" />
                <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full rounded-lg border-gray-300 shadow-sm focus:ring-indigo-500 focus:border-indigo-500" 
                              :value="old('website_url', $user->website_url)" placeholder="https://example.com"/>
                <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
            </div>
        </div>

        <div class="flex items-center gap-4 mt-6">
            <x-primary-button class="bg-indigo-600 hover:bg-indigo-700 shadow-md">{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-500"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>
