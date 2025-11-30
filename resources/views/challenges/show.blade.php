<x-app-layout>
    <div class="py-8 bg-gray-100 min-h-screen">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            <div class="bg-white shadow-lg sm:rounded-xl p-6">

                <!-- Judul Challenge -->
                <h1 class="text-3xl font-bold text-gray-900 mb-4">{{ $challenge->title }}</h1>

                <!-- Deskripsi -->
                @if($challenge->description)
                    <p class="mt-2 text-gray-700 text-lg">{{ $challenge->description }}</p>
                @endif

                <!-- Info Tambahan: Aturan, Hadiah, Deadline -->
                <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4 text-gray-700">
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <h2 class="font-semibold text-gray-800 mb-2">Aturan</h2>
                        <p class="text-sm">{{ $challenge->rules }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <h2 class="font-semibold text-gray-800 mb-2">Hadiah</h2>
                        <p class="text-sm">{{ $challenge->prize ?? 'Tidak ada hadiah' }}</p>
                    </div>
                    <div class="bg-gray-50 p-4 rounded-lg shadow-sm transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                        <h2 class="font-semibold text-gray-800 mb-2">Waktu</h2>
                        <p class="text-sm">Mulai: {{ $challenge->start_date->format('d M Y') }}</p>
                        <p class="text-sm">Deadline: {{ $challenge->end_date->format('d M Y') }}</p>
                    </div>
                </div>

                <!-- Tombol Submit & Kembali -->
                @auth
                    @if(auth()->user()->role === 'member' && now()->lt($challenge->end_date))
                        <div class="mt-6 flex flex-wrap gap-4">
                            <a href="{{ route('challenges.submit.form', $challenge) }}" 
                               class="bg-green-600 text-white px-5 py-2 rounded-lg shadow hover:bg-green-700 transition transform hover:scale-105">
                                Submit Karyamu
                            </a>
                            <a href="{{ url()->previous() }}" 
                               class="bg-gray-300 text-gray-800 px-5 py-2 rounded-lg shadow hover:bg-gray-400 transition transform hover:scale-105">
                                Kembali
                            </a>
                        </div>
                    @endif
                @endauth

                <!-- Pemenang -->
                @if($winners->count())
                    <div class="mt-10">
                        <h3 class="text-xl font-bold text-gray-800 mb-4">🏆 Pemenang</h3>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                            @foreach(['1', '2', '3'] as $num)
                                @php
                                    $winner = $winners->firstWhere('winner_position', $num);
                                @endphp
                                @if($winner)
                                    <div class="relative bg-gray-50 rounded-lg shadow-lg overflow-hidden transform transition-all duration-300 hover:scale-105 hover:shadow-2xl">
                                        <!-- Badge nomor juara -->
                                        <span class="absolute top-3 left-3 bg-yellow-400 text-white font-bold px-3 py-1 rounded-full shadow">
                                            {{ $num }}
                                        </span>

                                        <!-- Foto karya -->
                                        <a href="{{ route('artworks.show', $winner->artwork) }}" class="block">
                                            <img src="{{ asset('storage/' . $winner->artwork->file_path) }}" 
                                                 alt="{{ $winner->artwork->title }}"
                                                 class="w-full h-64 object-contain bg-white p-2 rounded">
                                        </a>

                                        <!-- Nama peserta -->
                                        <p class="text-center text-gray-800 font-medium py-2">
                                            {{ $winner->artwork->user->name }}
                                        </p>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                @endif

                <!-- Galeri Submission -->
                <div class="mt-10">
                    <h3 class="text-xl font-semibold text-gray-800 mb-4">
                        Karya yang Di-Submit ({{ $submissions->count() }})
                    </h3>
                    @if($submissions->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($submissions as $sub)
                                <a href="{{ route('artworks.show', $sub->artwork) }}" 
                                   class="block transform transition-all duration-300 hover:scale-105 hover:shadow-lg">
                                    <img src="{{ asset('storage/' . $sub->artwork->file_path) }}" 
                                         alt="{{ $sub->artwork->title }}"
                                         class="w-full h-40 object-contain rounded-lg border shadow-sm bg-white p-1">
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
