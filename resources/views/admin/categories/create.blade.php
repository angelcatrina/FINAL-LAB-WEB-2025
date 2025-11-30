<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">Tambah Kategori</h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg border border-gray-300 rounded-xl p-8">

                <h3 class="text-xl font-semibold text-gray-800 mb-6">Buat Kategori Baru</h3>

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <!-- Nama Kategori -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-700 font-semibold mb-2">Nama Kategori</label>
                        <input id="name" name="name" type="text" required
                               class="w-full bg-gray-50 text-gray-900 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tombol aksi -->
                    <div class="flex justify-center gap-4 mt-6">
                        <button type="submit" 
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Tambah
                        </button>

                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-5 py-2.5 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
