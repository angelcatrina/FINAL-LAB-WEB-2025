<section class="max-w-3xl mx-auto py-10 px-4">
    <header class="mb-6 text-center">
        <h2 class="text-2xl font-semibold text-gray-900">
            {{ __('Manage Profile Information') }}
        </h2>
        <p class="mt-2 text-gray-600">
            Kelola informasi profil publik yang penting, seperti Nama Tampilan, Foto Profil, Bio/Deskripsi Singkat, dan Tautan Eksternal (misal: Instagram, Behance, atau Website pribadi).
        </p>
    </header>

    {{-- Form untuk verifikasi email --}}
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    {{-- Form Update Profil --}}
    <form method="post" action="{{ route('profile.update') }}" class="mt-6 space-y-6" enctype="multipart/form-data">
        @csrf
        @method('patch')

        {{-- Foto Profil --}}
        <div class="flex flex-col items-center">
            <label for="avatar" class="cursor-pointer">
                @if($user->avatar_path)
                    <img id="avatarPreview" src="{{ asset('storage/' . $user->avatar_path) }}" alt="Avatar" class="w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-md hover:opacity-80 transition-opacity duration-200">
                @else
                    <div id="avatarPreview" class="w-32 h-32 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-bold text-4xl border-4 border-gray-200 shadow-md hover:opacity-80 transition-opacity duration-200">
                        {{ strtoupper(substr($user->display_name ?? $user->name, 0, 1)) }}
                    </div>
                @endif
            </label>
            <input type="file" id="avatar" name="avatar" class="hidden" accept="image/*" onchange="previewAvatar(event)">
            <p class="text-sm text-gray-500 mt-2">Klik gambar untuk mengganti foto profil</p>
        </div>

        {{-- Nama Tampilan / Display Name --}}
        <div>
            <x-input-label for="display_name" :value="__('Display Name')" />
            <x-text-input id="display_name" name="display_name" type="text" class="mt-1 block w-full" :value="old('display_name', $user->display_name)" autocomplete="display_name" />
            <x-input-error class="mt-2" :messages="$errors->get('display_name')" />
        </div>

        {{-- Nama / Name --}}
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        {{-- Email --}}
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
            <x-input-error class="mt-2" :messages="$errors->get('email')" />

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div>
                    <p class="text-sm mt-2 text-gray-800">
                        {{ __('Your email address is unverified.') }}
                        <button form="send-verification" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
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

        {{-- Bio / Deskripsi --}}
        <div>
            <x-input-label for="bio" :value="__('Bio / Deskripsi Singkat')" />
            <textarea id="bio" name="bio" rows="3" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">{{ old('bio', $user->bio) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('bio')" />
        </div>

        {{-- Tautan Eksternal --}}
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
    <div>
        <x-input-label for="instagram_url" :value="__('Instagram')" />
        <x-text-input id="instagram_url" name="instagram_url" type="url" class="mt-1 block w-full" :value="old('instagram_url', $user->instagram_url)" placeholder="https://instagram.com/username"/>
        <x-input-error class="mt-2" :messages="$errors->get('instagram_url')" />
    </div>

    <div>
        <x-input-label for="behance_url" :value="__('Behance')" />
        <x-text-input id="behance_url" name="behance_url" type="url" class="mt-1 block w-full" :value="old('behance_url', $user->behance_url)" placeholder="https://behance.net/username"/>
        <x-input-error class="mt-2" :messages="$errors->get('behance_url')" />
    </div>

    <div>
        <x-input-label for="website_url" :value="__('Website')" />
        <x-text-input id="website_url" name="website_url" type="url" class="mt-1 block w-full" :value="old('website_url', $user->website_url)" placeholder="https://example.com"/>
        <x-input-error class="mt-2" :messages="$errors->get('website_url')" />
    </div>
</div>

               
        {{-- Tombol Submit --}}
        <div class="flex items-center gap-4 mt-4">
            <x-primary-button>{{ __('Save') }}</x-primary-button>

            @if (session('status') === 'profile-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Saved.') }}</p>
            @endif
        </div>
    </form>
</section>

{{-- Preview JS --}}
<script>
function previewAvatar(event) {
    const reader = new FileReader();
    reader.onload = function(){
        const output = document.getElementById('avatarPreview');
        output.src = reader.result;
        if(output.tagName !== 'IMG'){
            // jika div, ganti isinya menjadi img
            const img = document.createElement('img');
            img.id = 'avatarPreview';
            img.src = reader.result;
            img.className = 'w-32 h-32 rounded-full object-cover border-4 border-gray-200 shadow-md';
            output.replaceWith(img);
        }
    }
    reader.readAsDataURL(event.target.files[0]);
}
</script>
