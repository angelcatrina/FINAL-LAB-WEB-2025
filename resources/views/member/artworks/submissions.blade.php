<x-app-layout>
    <div class="max-w-[1600px] mx-auto px-6 py-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-900">Riwayat Submissions</h1>

        @if($submissions->count())
            {{-- Masonry Grid --}}
            <div class="columns-1 sm:columns-2 md:columns-3 lg:columns-4 gap-6">
                @foreach($submissions as $artwork)
                    <div class="break-inside-avoid mb-6 relative group cursor-pointer overflow-hidden rounded-2xl shadow-lg hover:shadow-2xl transition-all duration-300 bg-white">
                        {{-- Foto Utuh --}}
                        <img src="{{ asset('storage/' . $artwork->file_path) }}" 
                             alt="{{ $artwork->title }}" 
                             class="w-full object-contain transition-transform duration-500 group-hover:scale-105">

                        {{-- Overlay info saat hover --}}
                        <div class="absolute inset-0 bg-black bg-opacity-30 opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex flex-col justify-end p-4 rounded-2xl">
                            <h3 class="text-white font-bold text-lg mb-1">{{ $artwork->title }}</h3>
                            <span class="inline-block bg-red-600 text-white text-xs px-2 py-1 rounded-full mb-2">
                                {{ $artwork->category->name ?? 'No Category' }}
                            </span>
                            <p class="text-white text-sm mb-1 line-clamp-3">{{ $artwork->description }}</p>
                            <div class="text-xs text-gray-200">
                                Dikirim ke:
                                @foreach($artwork->submissions as $submission)
                                    <span class="font-medium">{{ $submission->challenge->title }}</span> 
                                    ({{ $submission->created_at->format('d M Y H:i') }})@if(!$loop->last), @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="flex flex-col items-center justify-center py-20">
                <h3 class="text-2xl font-semibold text-gray-900 mb-4">Belum ada submissions</h3>
                <a href="{{ route('member.artworks.index') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                    Lihat Karya Saya
                </a>
            </div>
        @endif
    </div>
</x-app-layout>
