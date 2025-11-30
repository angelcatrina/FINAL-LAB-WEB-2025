<x-app-layout>
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6 space-y-4">

               
                <h1 class="text-2xl font-bold">{{ $challenge->title }}</h1>
                <p class="text-gray-600 mt-2">{{ $challenge->description }}</p>

                <div class="mt-4 grid grid-cols-1 md:grid-cols-2 gap-4 text-sm">
                    <div>
                        <h2 class="font-semibold">Aturan</h2>
                        <p>{{ $challenge->rules }}</p>
                    </div>
                    <div>
                        <h2 class="font-semibold">Hadiah & Deadline</h2>
                        <p>Hadiah: {{ $challenge->prize ?? '–' }}</p>
                        <p>Deadline: {{ $challenge->end_date->format('d M Y') }}</p>
                    </div>
                </div>

               
                @auth
                    @if(auth()->user()->role === 'member')
                        @if($challenge->end_date->isFuture())
                            @if($availableArtworks->isNotEmpty())
                                <form method="POST" action="{{ route('challenges.submit.store', $challenge) }}">
                                    @csrf
                                    <div class="space-y-4">
                                        @foreach($availableArtworks as $art)
                                            <label class="flex items-center p-3 border rounded hover:bg-gray-50 cursor-pointer">
                                                <img src="{{ asset('storage/' . $art->file_path) }}" 
                                                     class="w-16 h-16 object-cover rounded mr-4">
                                                <span>{{ $art->title }}</span>
                                                <input type="radio" name="artwork_id" value="{{ $art->id }}" class="ml-auto">
                                            </label>
                                        @endforeach
                                    </div>
                                    <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">
                                        Submit Your Work
                                    </button>
                                </form>
                            @else
                                <p class="text-gray-500 mt-2">Anda belum memiliki karya untuk disubmit.</p>
                            @endif
                        @else
                            <p class="text-red-500 mt-2">Challenge ini sudah berakhir. Tidak bisa submit karya.</p>
                        @endif
                    @endif
                @endauth

                @guest
                    <p class="text-gray-500 mt-2">Silakan login sebagai member untuk submit karya.</p>
                @endguest

                
                <div class="mt-6">
                    <h2 class="font-semibold text-lg mb-2">Galeri Submissions</h2>
                    @if($challenge->submissions->isEmpty())
                        <p class="text-gray-500">Belum ada submissions.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($challenge->submissions as $submission)
                                <div class="border rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $submission->artwork->file_path) }}" class="w-full h-32 object-cover">
                                    <div class="p-2 text-sm text-center">
                                        {{ $submission->artwork->title }} <br>
                                        <span class="text-gray-500">{{ $submission->artwork->user->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

                
                <div class="mt-6">
                    <h2 class="font-semibold text-lg mb-2">Pemenang</h2>
                    @if($winners->isEmpty())
                        <p class="text-gray-500">Pemenang akan diumumkan nanti.</p>
                    @else
                        <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                            @foreach($winners as $winner)
                                <div class="border rounded overflow-hidden">
                                    <img src="{{ asset('storage/' . $winner->artwork->file_path) }}" class="w-full h-32 object-cover">
                                    <div class="p-2 text-sm text-center">
                                        Juara {{ $winner->winner_position }} <br>
                                        {{ $winner->artwork->title }} <br>
                                        <span class="text-gray-500">{{ $winner->artwork->user->name }}</span>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
