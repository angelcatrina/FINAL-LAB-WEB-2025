<x-app-layout>
    
    {{-- <x-slot name="header"></x-slot> --}}

    <div class="min-h-screen bg-gray-200 py-10">
        <div class="max-w-3xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="bg-white shadow-lg rounded-2xl p-10">
                <h2 class="text-2xl font-bold text-gray-800 text-center mb-6">Edit Challenge</h2>

                <form method="POST" action="{{ route('curator.challenges.update', $challenge) }}" enctype="multipart/form-data" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div>
                        <label for="title" class="block text-gray-700 font-medium mb-2">Judul Challenge</label>
                        <input type="text" name="title" id="title" required
                               value="{{ old('title', $challenge->title) }}"
                               class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                        <x-input-error :messages="$errors->get('title')" class="mt-1 text-red-600"/>
                    </div>

                  
                    <div>
                        <label for="description" class="block text-gray-700 font-medium mb-2">Deskripsi</label>
                        <textarea name="description" id="description" rows="3" required
                                  class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">{{ old('description', $challenge->description) }}</textarea>
                        <x-input-error :messages="$errors->get('description')" class="mt-1 text-red-600"/>
                    </div>

                 
                    <div>
                        <label for="rules" class="block text-gray-700 font-medium mb-2">Aturan</label>
                        <textarea name="rules" id="rules" rows="3" required
                                  class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">{{ old('rules', $challenge->rules) }}</textarea>
                        <x-input-error :messages="$errors->get('rules')" class="mt-1 text-red-600"/>
                    </div>

                    <div>
                        <label for="prize" class="block text-gray-700 font-medium mb-2">Hadiah (opsional)</label>
                        <input type="text" name="prize" id="prize"
                               value="{{ old('prize', $challenge->prize) }}"
                               class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="start_date" class="block text-gray-700 font-medium mb-2">Tanggal Mulai</label>
                            <input type="date" name="start_date" id="start_date" required
                                   value="{{ old('start_date', $challenge->start_date->format('Y-m-d')) }}"
                                   class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                            <x-input-error :messages="$errors->get('start_date')" class="mt-1 text-red-600"/>
                        </div>
                        <div>
                            <label for="end_date" class="block text-gray-700 font-medium mb-2">Tanggal Berakhir</label>
                            <input type="date" name="end_date" id="end_date" required
                                   value="{{ old('end_date', $challenge->end_date->format('Y-m-d')) }}"
                                   class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                            <x-input-error :messages="$errors->get('end_date')" class="mt-1 text-red-600"/>
                        </div>
                    </div>

                    <div>
                        <label for="banner" class="block text-gray-700 font-medium mb-2">Ganti Banner (opsional)</label>
                        <input type="file" name="banner" id="banner" accept="image/*"
                               class="w-full rounded-xl bg-gray-50 text-gray-900 border border-gray-300 px-4 py-3 focus:outline-none focus:ring-2 focus:ring-indigo-400 focus:border-indigo-400">
                        <x-input-error :messages="$errors->get('banner')" class="mt-1 text-red-600"/>
                        @if($challenge->banner_path)
                            <div class="mt-3">
                                <img src="{{ asset('storage/' . $challenge->banner_path) }}" alt="Banner Preview"
                                     class="w-48 h-28 object-cover rounded-lg border border-gray-300 shadow">
                            </div>
                        @endif
                    </div>
                    <div class="flex items-center gap-4 mt-6">
                        <button type="submit" 
                                class="bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-6 py-3 rounded-xl transition-all duration-200 shadow-lg">
                            Perbarui Challenge
                        </button>
                        <a href="{{ route('curator.challenges.index') }}" 
                           class="text-gray-700 hover:text-gray-900 transition font-medium">Batal</a>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>
