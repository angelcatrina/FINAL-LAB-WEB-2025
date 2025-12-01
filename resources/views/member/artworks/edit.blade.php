<x-app-layout>
    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Edit Karya
        </h2>
    </x-slot>

    <div class="flex justify-center py-8 bg-gray-100 min-h-screen px-4">
        <div class="w-full max-w-3xl bg-white shadow-xl rounded-2xl p-6 sm:p-8 overflow-y-auto">

            <form method="POST" action="{{ route('member.artworks.update', $artwork) }}" enctype="multipart/form-data" class="space-y-6">
                @csrf
                @method('PUT')

              
                <div>
                    <label for="title" class="block text-gray-700 font-semibold mb-1">Judul</label>
                    <input type="text" name="title" id="title" required
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all"
                        value="{{ old('title', $artwork->title) }}">
                    <x-input-error :messages="$errors->get('title')" class="mt-1" />
                </div>

               
                <div>
                    <label for="category_id" class="block text-gray-700 font-semibold mb-1">Kategori</label>
                    <select name="category_id" id="category_id" required
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all">
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ (old('category_id') ?? $artwork->category_id) == $category->id ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('category_id')" class="mt-1" />
                </div>

              
                <div>
                    <label for="description" class="block text-gray-700 font-semibold mb-1">Deskripsi</label>
                    <textarea name="description" id="description" rows="4"
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all"
                        required>{{ old('description', $artwork->description) }}</textarea>
                    <x-input-error :messages="$errors->get('description')" class="mt-1" />
                </div>

            
                <div>
                    <label for="file" class="block text-gray-700 font-semibold mb-1">Ganti Gambar (opsional)</label>
                    <input type="file" name="file" id="file" accept="image/*"
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all">
                    <x-input-error :messages="$errors->get('file')" class="mt-1" />
                    @if($artwork->file_path)
                        <div class="mt-2">
                            <img src="{{ asset('storage/' . $artwork->file_path) }}" alt="Preview"
                                 class="w-32 h-32 object-cover rounded-xl border shadow-sm">
                        </div>
                    @endif
                </div>

            
                <div>
                    <label for="tags" class="block text-gray-700 font-semibold mb-1">Tags (opsional)</label>
                    <input type="text" name="tags" id="tags" placeholder="Contoh: digital art, karakter"
                        class="w-full px-4 py-2 rounded-xl border border-gray-300 focus:outline-none focus:ring-2 focus:ring-gray-400 transition-all"
                        value="{{ old('tags', $artwork->tags) }}">
                    <x-input-error :messages="$errors->get('tags')" class="mt-1" />
                </div>

             
                <div class="flex justify-end items-center gap-4">
                    <button type="submit"
                        class="bg-gray-800 hover:bg-gray-900 text-white px-6 py-2 rounded-xl shadow-lg font-semibold transition-all">
                        Perbarui
                    </button>
                    <a href="{{ route('member.artworks.index') }}"
                       class="text-gray-600 hover:text-gray-900 transition-all">
                        Batal
                    </a>
                </div>

            </form>
        </div>
    </div>
</x-app-layout>
