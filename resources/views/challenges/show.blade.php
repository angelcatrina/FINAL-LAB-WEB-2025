<x-app-layout>
    <div class="py-12 bg-gray-200 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-gray-800 shadow-xl sm:rounded-2xl p-8">

                <h1 class="text-4xl font-extrabold text-gray-100 mb-6 text-center">{{ $challenge->title }}</h1>

                @if($challenge->description)
                    <p class="text-white text-lg mb-6 text-center">{{ $challenge->description }}</p>
                @endif

                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-indigo-50 p-5 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <h2 class="font-semibold text-gray-800 mb-2">Aturan</h2>
                        <p class="text-sm text-gray-700">{{ $challenge->rules }}</p>
                    </div>
                    <div class="bg-green-50 p-5 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <h2 class="font-semibold text-gray-800 mb-2">Hadiah</h2>
                        <p class="text-sm text-gray-700">{{ $challenge->prize ?? 'Tidak ada hadiah' }}</p>
                    </div>
                    <div class="bg-yellow-50 p-5 rounded-xl shadow hover:shadow-lg transition transform hover:scale-105">
                        <h2 class="font-semibold text-gray-800 mb-2">Waktu</h2>
                        <p class="text-sm text-gray-700">Mulai: {{ $challenge->start_date->format('d M Y') }}</p>
                        <p class="text-sm text-gray-700">Deadline: {{ $challenge->end_date->format('d M Y') }}</p>
                    </div>
                </div>
                @auth
                    @if(auth()->user()->role === 'member' && now()->lt($challenge->end_date))
                        <div class="mt-8 flex flex-wrap justify-center gap-4">
                            <a href="{{ route('challenges.submit.form', $challenge) }}" 
                               class="bg-green-600 text-white px-6 py-3 rounded-2xl shadow hover:bg-green-700 transition transform hover:scale-105 font-semibold">
                                Submit Karyamu
                            </a>
                            <a href="{{ url()->previous() }}" 
                               class="bg-gray-300 text-gray-800 px-6 py-3 rounded-2xl shadow hover:bg-gray-400 transition transform hover:scale-105 font-semibold">
                                Kembali
                            </a>
                        </div>
                    @endif
                @endauth
                @if($winners->count())
                    <div class="mt-12">
                        <h3 class="text-2xl font-bold text-white mb-6 border-b pb-2">🏆 Pemenang</h3>
                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6">
                            @foreach(['1', '2', '3'] as $num)
                                @php
                                    $winner = $winners->firstWhere('winner_position', $num);
                                @endphp
                                @if($winner)
                                    <div class="relative bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-2xl transform transition-all duration-300 hover:scale-105">
                                        
                                        <span class="absolute top-3 left-3 bg-yellow-400 text-white font-bold px-3 py-1 rounded-full shadow">
                                            {{ $num }}
                                        </span>

                                        <a href="{{ route('artworks.show', $winner->artwork) }}" class="block">
                                            <img src="{{ asset('storage/' . $winner->artwork->file_path) }}" 
                                                 alt="{{ $winner->artwork->title }}"
                                                 class="w-full h-64 object-contain p-2 bg-gray-50 rounded-t-xl">
                                        </a>

                                        <p class="text-center text-gray-800 font-medium py-3 bg-gray-50">{{ $winner->artwork->user->name }}</p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Submissions --}}
                <div class="mt-12">
                    <h3 class="text-2xl font-semibold text-white mb-6 border-b pb-2">
                        Karya yang Di-Submit ({{ $submissions->count() }})
                    </h3>
                    @if($submissions->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($submissions as $sub)
                                <a href="{{ route('artworks.show', $sub->artwork) }}" 
                                   class="block transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <img src="{{ asset('storage/' . $sub->artwork->file_path) }}" 
                                         alt="{{ $sub->artwork->title }}"
                                         class="w-full h-40 object-contain rounded-xl border shadow-sm bg-white p-2">
                                </a>
                            @endforeach
                        </div>
                    @else
                        <p class="text-gray-500 mt-2">Belum ada karya yang di-submit ke challenge ini.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
