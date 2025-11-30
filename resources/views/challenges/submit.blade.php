<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">Submit ke Challenge: {{ $challenge->title }}</h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <p class="mb-4">Pilih satu karya dari portofolio Anda untuk di-submit:</p>

                <form method="POST" action="{{ route('challenges.submit.store', $challenge) }}">
                    @csrf
                    <div class="space-y-4">
                        @foreach($availableArtworks as $art)
                            <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                <img src="{{ asset('storage/' . $art->file_path) }}" 
                                     class="w-16 h-16 object-cover rounded mr-4">
                                <span>{{ $art->title }}</span>
                                <input type="radio" 
                                       name="artwork_id" 
                                       value="{{ $art->id }}" 
                                       class="ml-auto" 
                                       required>
                            </label>
                        @endforeach
                    </div>

                    <div class="mt-6 flex gap-3">
                        <x-primary-button>Submit</x-primary-button>
                        <a href="{{ route('challenges.show', $challenge) }}" class="text-gray-600">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>