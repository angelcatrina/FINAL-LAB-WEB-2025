<x-app-layout>
    {{-- Main Content Container --}}
    <div class="flex-1 ml-20"> 
        
    

        <div class="max-w-[1600px] mx-auto px-6 py-8">
            
            {{-- Bagian Utama Daftar Favorit --}}
            <h2 class="text-3xl font-bold text-gray-900 mb-8 border-b pb-4">Daftar Favorit Saya</h2>

            {{-- 1. Mengubah Grid Layout dan Card Styling --}}
            <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-6">
                
                @forelse ($favorites as $fav)
                    {{-- Card Item --}}
                    <div class="group relative bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 overflow-hidden flex flex-col transform hover:-translate-y-1">
                        
                        {{-- 2. Gambar Artwork dan Link Detail --}}
                        <a href="{{ route('artworks.show', $fav->artwork->id) }}"
title="{{ $fav->artwork->title }}" class="relative w-full h-48 overflow-hidden flex-shrink-0">
                            <img src="{{ asset('storage/' . $fav->artwork->file_path) }}" 
                                alt="{{ $fav->artwork->title }}" 
                                class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-105">
                            
                            {{-- Overlay untuk visual hover --}}
                            <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                        </a>

                        {{-- 3. Info Artwork --}}
                        <div class="p-4 flex-grow">
                            <h3 class="font-bold text-lg text-gray-900 mb-1 line-clamp-1">
                                {{ $fav->artwork->title }}
                            </h3>
                            <p class="text-gray-500 text-sm line-clamp-2 mb-3">
                                {{ $fav->artwork->description }}
                            </p>
                            
                            {{-- Detail Penulis --}}
                            <p class="text-xs text-blue-600 font-medium">
                                Oleh: {{ $fav->artwork->user->display_name ?? $fav->artwork->user->name }}
                            </p>
                        </div>

                        {{-- 4. Tombol Hapus Favorit --}}
                        <div class="p-4 border-t border-gray-100">
                            {{-- Form ini akan memicu method DELETE pada route 'member.artworks.favorite', yang menghapus favorit --}}
                            <form action="{{ route('member.artworks.favorite', $fav->artwork->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 bg-red-50 hover:bg-red-100 text-red-600 px-3 py-2 rounded-lg font-semibold text-sm transition-all duration-200">
                                    
                                    {{-- Ikon Sampah (Trash) untuk indikasi Hapus --}}
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                    Hapus dari Favorit
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    {{-- Fallback jika Favorit Kosong --}}
                    <div class="col-span-full py-12 text-center bg-white rounded-xl shadow-lg border border-gray-200">
                        <svg class="w-12 h-12 mx-auto text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"></path></svg>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum ada karya favorit</h3>
                        <p class="text-gray-500">Temukan karya yang Anda sukai di galeri publik dan tambahkan ke favorit Anda!</p>
                        <a href="{{ route('home') }}" class="mt-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-full shadow-sm text-white bg-blue-600 hover:bg-blue-700 transition">
                            Jelajahi Karya
                        </a>
                    </div>
                @endforelse
            </div>

        </div> 
    </div>
</x-app-layout>