<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-900">Dashboard Curator</h2>
    </x-slot>

    <!-- Wrapper utama -->
    <div class="min-h-screen bg-gray-100 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Intro text -->
            <p class="text-gray-700 mb-8 text-lg">Halo, Curator! Gunakan shortcut berikut untuk mengelola challenge dan submissions.</p>

            <!-- Grid card -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

                <!-- Challenge Management -->
                <a href="{{ route('curator.challenges.index') }}" 
                   class="relative p-6 rounded-xl bg-white shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-200 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-800 font-bold text-xl">C</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Challenge Management</h3>
                    <p class="text-gray-700 text-sm">Buat, edit, dan hapus challenge milik Anda.</p>
                </a>

                <!-- Manage Submissions -->
                <a href="{{ route('curator.submissions.index') }}" 
                   class="relative p-6 rounded-xl bg-gray-300 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-900 font-bold text-xl">S</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Manage Submissions & Winners</h3>
                    <p class="text-gray-800 text-sm">Tinjau karya partisipan dan pilih pemenang challenge.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
