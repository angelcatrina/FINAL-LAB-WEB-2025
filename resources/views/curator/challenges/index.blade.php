<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Kelola Challenge</h2>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            {{-- Tombol Buat Challenge --}}
            <div class="mb-6 flex justify-end">
                <a href="{{ route('curator.challenges.create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded-md shadow-md transition duration-200">
                    + Buat Challenge
                </a>
            </div>

            @if($challenges->count())
                <div class="grid gap-6 md:grid-cols-2 lg:grid-cols-3">
                    @foreach($challenges as $c)
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md hover:shadow-lg transition duration-200 p-5 flex flex-col justify-between">
                            
                            {{-- Judul dan Status --}}
                            <div>
                                <h3 class="text-xl font-bold text-gray-800">{{ $c->title }}</h3>
                                <p class="text-gray-500 mt-1 text-sm">
                                    Berakhir: <span class="font-medium">{{ $c->end_date->format('d M Y') }}</span>
                                </p>

                                @if(now()->gt($c->end_date))
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold bg-green-100 text-green-800 rounded-full">
                                        Challenge Selesai
                                    </span>
                                @else
                                    <span class="inline-block mt-2 px-2 py-1 text-xs font-semibold bg-yellow-100 text-yellow-800 rounded-full">
                                        Sedang Berlangsung
                                    </span>
                                @endif
                            </div>

                            {{-- Tombol aksi --}}
                            <div class="mt-4 flex flex-wrap gap-2">
                                <a href="{{ route('challenges.show', $c) }}" 
                                   class="flex-1 text-center bg-blue-50 hover:bg-blue-100 text-blue-700 font-semibold py-2 rounded-md transition duration-200">
                                   Lihat Publik
                                </a>

                                <a href="{{ route('curator.challenges.edit', $c) }}" 
                                   class="flex-1 text-center bg-gray-50 hover:bg-gray-100 text-gray-700 font-semibold py-2 rounded-md transition duration-200">
                                   Edit
                                </a>

                                <form method="POST" action="{{ route('curator.challenges.destroy', $c) }}" 
                                      class="flex-1"
                                      onsubmit="return confirm('Hapus challenge ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            class="w-full bg-red-50 hover:bg-red-100 text-red-600 font-semibold py-2 rounded-md transition duration-200">
                                        Hapus
                                    </button>
                                </form>

                                @if(now()->gt($c->end_date))
                                    <a href="{{ route('curator.challenges.winners', $c) }}" 
                                       class="flex-1 text-center bg-green-50 hover:bg-green-100 text-green-700 font-semibold py-2 rounded-md transition duration-200">
                                        Lihat Pemenang
                                    </a>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <p class="text-gray-500 text-center mt-10 text-lg">
                    Belum ada challenge. 
                    <a href="{{ route('curator.challenges.create') }}" 
                       class="text-blue-600 font-semibold hover:underline">
                        Buat sekarang
                    </a>.
                </p>
            @endif
        </div>
    </div>
</x-app-layout>
