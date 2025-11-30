<!-- resources/views/auth/register.blade.php -->
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="{{ route('home') }}">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}" class="space-y-4">
            @csrf

            <!-- Name -->
            <div>
                <p class="text-sm text-gray-600 mb-1">Isi Nama Lengkap Anda</p>
                <x-label for="name" :value="__('Name')" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div>
                <p class="text-sm text-gray-600 mb-1">Masukkan Email yang Aktif</p>
                <x-label for="email" :value="__('Email')" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Role -->
<div class="mt-4">
    <label for="role" class="block text-sm font-medium text-gray-700">Daftar Sebagai</label>
    <select name="role" id="role" required
        class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
        <option value="member">Member</option>
        <option value="curator">Curator</option>
    </select>
</div>


            <!-- Password -->
            <div>
                <p class="text-sm text-gray-600 mb-1">Buat Password Minimal 8 Karakter</p>
                <x-label for="password" :value="__('Password')" />
                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div>
                <p class="text-sm text-gray-600 mb-1">Konfirmasi Password Anda</p>
                <x-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <!-- Submit Button -->
         <div class="flex justify-center mt-4">
    <button type="submit"
        style="
            background-color:#007BFF;
            color:white;
            padding:10px 20px;
            border:none;
            border-radius:6px;
            font-weight:600;
            width:100%;
            max-width:260px;
            cursor:pointer;
        "
        onmouseover="this.style.backgroundColor='#0056D2'"
        onmouseout="this.style.backgroundColor='#007BFF'"
    >
        Register
    </button>
</div>

            </div>
        </form>
    </x-auth-card>
</x-guest-layout>
