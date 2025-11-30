<x-app-layout>

    <div class="py-8 min-h-screen 
            bg-gradient-to-b from-gray-300 via-white to-gray-400">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Search & Filter -->
            <div class="bg-white p-6 rounded-lg shadow mb-8">
                <form method="GET" class="flex flex-col md:flex-row gap-4">

                    <!-- Search -->
<input type="text" name="search" value="{{ request('search') }}"
       placeholder="Cari karya atau kreator..."
       class="flex-1 rounded-md shadow-sm px-3 py-2
              bg-gradient-to-r from-gray-200 via-white to-gray-300
              border border-gray-300 focus:ring-blue-500 focus:border-blue-500">

<!-- Category -->
<select name="category"
        class="rounded-md shadow-sm px-3 py-2
               bg-gradient-to-r from-gray-200 via-white to-gray-300
               border border-gray-300 focus:ring-blue-500 focus:border-blue-500">
    <option value="">Semua Kategori</option>
    @foreach($categories as $cat)
        <option value="{{ $cat->id }}" {{ request('category') == $cat->id ? 'selected' : '' }}>
            {{ $cat->name }}
        </option>
    @endforeach
</select>

<button type="submit"
        class="bg-gradient-to-r from-blue-500 to-blue-600 text-white px-6 py-2 rounded-md shadow
               hover:from-blue-600 hover:to-blue-700 transition">
    Cari
</button>

                </form>
            </div>

            {{-- ANNOUNCED WINNERS --}}
            @if(isset($announcedChallenges) && $announcedChallenges->count() > 0)
                <h2 class="text-2xl font-bold mb-4 text-gray-800">🏆 Pemenang Challenge</h2>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
                    @foreach($announcedChallenges as $challenge)
                        <div class="bg-white shadow rounded-lg p-5 border border-gray-200
                                    transform transition-all duration-500 ease-out hover:scale-105 hover:shadow-2xl">
                            <h3 class="font-bold text-xl mb-2 text-gray-800">
                                🎯 {{ $challenge->title }}
                            </h3>

                            <p class="text-sm text-gray-600 mb-4">{{ $challenge->rules }}</p>

                            @foreach($challenge->submissions as $winner)
                                @php
                                    $badge = match($winner->winner_position) {
                                        1 => 'bg-yellow-400',
                                        2 => 'bg-gray-300',
                                        3 => 'bg-amber-700',
                                        default => 'bg-gray-400'
                                    };
                                @endphp

                                <div class="flex items-start gap-3 mb-4 p-2 bg-gray-50 rounded-lg border">
                                    <img src="{{ asset('storage/' . $winner->artwork->file_path) }}"
                                         class="w-16 h-16 rounded object-cover">

                                    <div>
                                        <span class="px-2 py-1 text-xs text-white rounded {{ $badge }}">
                                            Juara {{ $winner->winner_position }}
                                        </span>

                                        <h4 class="font-semibold text-md mt-1 text-gray-800">{{ $winner->artwork->title }}</h4>
                                        <p class="text-xs text-gray-500">{{ $winner->artwork->user->name }}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Featured Section -->
            
<h2 class="text-2xl font-bold mb-4 text-gray-800">Karya Terbaru</h2>

            @if($artworks->count())
                <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4">
                    @foreach($artworks as $art)
                        <div class="mb-4 break-inside-avoid bg-white rounded-lg overflow-hidden
                                    transform transition-all duration-500 ease-out hover:scale-105 hover:shadow-2xl">
                            <a href="{{ route('artworks.show', $art) }}">
                                <img src="{{ asset('storage/'.$art->file_path) }}" class="w-full object-cover">
                            </a>
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800">{{ $art->title }}</h3>
                                <p class="text-xs text-gray-500">{{ $art->user->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>

            <!-- Popular Section -->
            @if($popular->count())
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Populer</h2>
                <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-4 mb-8">
                    @foreach($popular as $art)
                        <div class="mb-4 break-inside-avoid bg-white rounded-lg overflow-hidden
                                    transform transition-all duration-500 ease-out hover:scale-105 hover:shadow-2xl">
                            <a href="{{ route('artworks.show', $art) }}">
                                <img src="{{ asset('storage/'.$art->file_path) }}" class="w-full object-cover">
                            </a>
                            <div class="p-3">
                                <h3 class="font-semibold text-gray-800">{{ $art->title }}</h3>
                                <p class="text-xs text-gray-500">{{ $art->user->name }}</p>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <!-- Latest Artworks -->
            
                <div class="mt-6">
                    {{ $artworks->links() }}
                </div>
            @else
                <p class="text-gray-500">Belum ada karya.</p>
            @endif

            <!-- Active Challenges -->
            @if($activeChallenges->count() > 0)
                <h2 class="text-2xl font-bold mb-4 text-gray-800">Active Challenges</h2>

                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-8">
                    @foreach($activeChallenges as $challenge)
                        <a href="{{ route('challenges.show', $challenge->id) }}"
                           class="p-4 bg-white shadow rounded-lg hover:shadow-xl transition
                                  transform duration-500 ease-out hover:scale-105">
                            <h3 class="font-semibold text-lg text-gray-800">{{ $challenge->title }}</h3>
                            <p class="text-sm text-gray-500">{{ Str::limit($challenge->description, 80) }}</p>

                            <p class="text-xs text-blue-600 mt-2">
                                {{ $challenge->start_date->format('d M Y') }} –
                                {{ $challenge->end_date->format('d M Y') }}
                            </p>
                        </a>
                    @endforeach
                </div>
            @endif

        </div>
    </div>
</x-app-layout>
