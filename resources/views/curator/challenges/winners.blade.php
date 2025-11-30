<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            🏆 Pemenang Challenge: {{ $challenge->title }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8">

            @php
                $winners = $submissions->where('is_winner', true)->sortBy('winner_position');

                // Warna kartu untuk masing2 juara
                $colors = [
                    1 => 'from-yellow-300 to-yellow-100',
                    2 => 'from-gray-300 to-gray-100',
                    3 => 'from-amber-400 to-amber-100'
                ];
            @endphp

            @if($winners->count())
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

                    @foreach([1, 2, 3] as $pos)
                        @php
                            $winner = $winners->firstWhere('winner_position', $pos);
                        @endphp

                        @if($winner)
                            <div class="rounded-2xl shadow-lg overflow-hidden transform hover:scale-[1.02] transition duration-300 bg-gradient-to-b {{ $colors[$pos] }}">
                                
                               
                                <div class="text-center py-3 bg-black/20 backdrop-blur-md">
                                    <span class="text-2xl font-bold text-gray-900 tracking-wide">
                                        🥇 Juara {{ $pos }}
                                    </span>
                                </div>

                                
                                <img 
                                    src="{{ asset('storage/' . $winner->artwork->file_path) }}" 
                                    class="w-full h-48 object-cover"
                                >

                                
                                <div class="p-4 text-center">
                                    <p class="font-bold text-lg text-gray-900">
                                        {{ $winner->artwork->title }}
                                    </p>

                                    <p class="text-gray-700 text-sm">
                                        oleh <span class="font-semibold">{{ $winner->artwork->user->name }}</span>
                                    </p>
                                </div>
                            </div>
                        @endif
                    @endforeach

                </div>
            @else
                <p class="text-gray-500 text-center text-lg py-8">
                    Belum ada pemenang untuk challenge ini.
                </p>
            @endif

           
            <div class="mt-8 text-center">
                <a href="{{ route('curator.challenges.index') }}"
                   class="px-5 py-2 bg-gray-700 text-white rounded-lg shadow hover:bg-gray-800 transition">
                    ← Kembali
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
