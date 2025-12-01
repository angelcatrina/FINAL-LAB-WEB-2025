<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="min-h-screen bg-gray-200 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Buat Kategori Baru
            </h1>

            <div class="bg-gray-700 shadow-xl rounded-2xl p-8">

                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf

                    <div class="mb-6">
                        <label for="name" class="block text-gray-200 font-semibold mb-2">Nama Kategori</label>
                        <input id="name" name="name" type="text" required
                               class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        @error('name')
                            <p class="text-red-400 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex justify-center gap-4 mt-8">
                        <button type="submit" 
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-500 shadow-md transition">
                            Tambah
                        </button>

                        <a href="{{ route('admin.categories.index') }}" 
                           class="px-6 py-2.5 bg-gray-600 text-gray-100 rounded-xl hover:bg-gray-500 shadow-md transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
