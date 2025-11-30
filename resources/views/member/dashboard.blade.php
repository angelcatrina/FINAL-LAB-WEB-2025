<x-app-layout>
    <div class="flex min-h-screen bg-gray-100">
        {{-- Sidebar (tidak diubah) --}}
        <aside class="w-20 bg-white border-r border-gray-200 flex flex-col items-center py-8 fixed h-full z-10">
            {{-- Home --}}
            <a href="{{ route('home') }}" class="mb-8 p-3 rounded-full hover:bg-gray-200 text-gray-700 hover:text-gray-900 transition-all duration-200" title="Home">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/>
                </svg>
            </a>

            {{-- Create --}}
            <a href="{{ route('member.artworks.create') }}" class="mb-8 p-3 rounded-full hover:bg-gray-200 text-gray-700 hover:text-gray-900 transition-all duration-200" title="Create">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/>
                </svg>
            </a>

            {{-- Favorites --}}
            <a href="{{ route('member.favorites') }}" class="mb-8 p-3 rounded-full hover:bg-gray-200 text-gray-700 hover:text-gray-900 transition-all duration-200" title="Favorites">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
            </a>

            {{-- Profile --}}
            <a href="{{ route('member.profile.edit') }}" class="mt-40 p-3 rounded-full hover:bg-gray-200 transition-all duration-200" title="Profile">
                @if(auth()->user()->avatar_path)
                    <img src="{{ asset('storage/' . auth()->user()->avatar_path) }}" class="w-10 h-10 rounded-full object-cover border-2 border-gray-300">
                @else
                    <div class="w-10 h-10 bg-gradient-to-br from-purple-400 to-pink-500 rounded-full flex items-center justify-center text-white font-semibold text-lg">
                        {{ strtoupper(substr(auth()->user()->display_name ?? auth()->user()->name, 0, 1)) }}
                    </div>
                @endif
            </a>
        </aside>

        {{-- Main Content --}}
        <main class="flex-1 ml-20">
            {{-- Header --}}
            <div class="bg-white border-b border-gray-200 sticky top-0 z-10">
                <div class="max-w-[1600px] mx-auto px-6 py-4">
                    <div class="flex items-center justify-between">
                        {{-- Bisa ditambah header konten --}}
                    </div>
                </div>
            </div>

            <div class="max-w-[1600px] mx-auto px-6 py-8">

                {{-- Notifikasi sukses --}}
                @if(session('success'))
                    <div class="mb-6 bg-green-50 border border-green-200 p-4 rounded-lg flex items-center gap-3">
                        <svg class="w-5 h-5 text-green-600 flex-shrink-0" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                        </svg>
                        <p class="text-green-800 font-medium">{{ session('success') }}</p>
                    </div>
                @endif

                {{-- Tabs Navigation --}}
                <div class="mb-8 border-b border-gray-200">
                    <nav class="flex gap-8">
                        <a href="{{ route('member.dashboard') }}"  class="pb-4 border-b-2 border-red-600 font-semibold text-gray-900">
                            Karya Saya
                        </a>
                        <a href="{{ route('member.artworks.submissions') }}" class="pb-4 border-b-2 border-transparent text-gray-600 hover:text-gray-900 font-medium">
                            Submissions
                        </a>
                    </nav>
                </div>

                @if($artworks->count())
                    {{-- Pinterest Masonry Grid --}}
                    <div class="columns-2 md:columns-3 lg:columns-4 xl:columns-5 2xl:columns-6 gap-4">
                        @foreach($artworks as $artwork)
                            <div x-data="{ open:false }" class="break-inside-avoid mb-4">
                                {{-- Kartu karya --}}
                                <div @click.stop="open = true" class="relative bg-white rounded-2xl overflow-hidden shadow-sm hover:shadow-xl transform transition-all duration-300 cursor-pointer">
                                    <img src="{{ asset('storage/' . $artwork->file_path) }}" alt="{{ $artwork->title }}" class="w-full object-cover">
                                    <div class="p-3">
                                        <p class="text-sm text-gray-800 font-medium line-clamp-2">{{ $artwork->title }}</p>
                                        <p class="text-xs text-gray-500 line-clamp-3 mt-1">{{ $artwork->description }}</p>
                                    </div>
                                </div>

                                {{-- Modal Detail Photo --}}
                                <div x-show="open"@click.stop x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-70 p-4">
                                    <div @click.away="open=false" class="bg-white rounded-2xl w-full md:w-4/5 lg:w-3/5 xl:w-1/2 max-h-[95vh] overflow-y-auto relative shadow-2xl">
                                        <button @click="open=false" class="absolute top-4 right-4 z-10 text-white bg-black/50 hover:bg-black/70 rounded-full p-2 transition">
                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                                            </svg>
                                        </button>

                                        <img src="{{ asset('storage/' . $artwork->file_path) }}" alt="{{ $artwork->title }}" class="w-full object-cover rounded-t-2xl">

                                        <div class="p-6">
                                            <h2 class="text-3xl font-bold text-gray-900 mb-2">{{ $artwork->title }}</h2>
                                            <p class="text-gray-700 text-lg mb-4">{{ $artwork->description }}</p>

                                            <div class="grid grid-cols-2 gap-4 border-t pt-4 mb-4">
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-600">Kategori:</p>
                                                    <p class="text-lg text-gray-900">{{ $artwork->category->name ?? 'Tidak Ada Kategori' }}</p>
                                                </div>
                                                <div>
                                                    <p class="text-sm font-semibold text-gray-600">Dibuat oleh:</p>
                                                    <p class="text-lg text-gray-900">{{ $artwork->user->display_name ?? $artwork->user->name }}</p>
                                                </div>
                                                <div class="col-span-2">
                                                    <p class="text-sm font-semibold text-gray-600">Tanggal Upload:</p>
                                                    <p class="text-lg text-gray-900">{{ $artwork->created_at->format('d M Y') }}</p>
                                                </div>
                                            </div>

                                            {{-- Actions: Like, Save, Report, Edit, Delete --}}
                                            <div class="flex gap-4 items-center border-t border-b py-4 mb-4">
                               @auth
@if(auth()->user()->role === 'member')
    @php
        $isLiked = $artwork->likes()->where('user_id', auth()->id())->exists();
    @endphp

    <button onclick="toggleLike({{ $artwork->id }})"
            id="like-btn-{{ $artwork->id }}"
            class="px-3 py-1 rounded font-semibold {{ $isLiked ? 'bg-red-100 text-red-600' : 'bg-gray-200 text-gray-700' }}">
        {{ $isLiked ? 'Unlike' : 'Like' }}
    </button>
@endif
@endauth

<script>
function toggleLike(artworkId) {
    const likeBtn = document.getElementById('like-btn-' + artworkId);

    fetch(`/member/artworks/${artworkId}/like`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({})
    })
    .then(res => res.json())
    .then(data => {
        if(data.is_liked){
            likeBtn.textContent = 'Unlike';
            likeBtn.classList.remove('bg-gray-200', 'text-gray-700');
            likeBtn.classList.add('bg-red-100', 'text-red-600');
        } else {
            likeBtn.textContent = 'Like';
            likeBtn.classList.remove('bg-red-100', 'text-red-600');
            likeBtn.classList.add('bg-gray-200', 'text-gray-700');
        }
    })
    .catch(err => console.error(err));
}
</script>


                                                {{-- Favorite --}}
                                                <form action="{{ route('member.artworks.favorite', $artwork->id) }}" method="POST">
                                                    @csrf
                                                    <button type="submit" class="flex items-center gap-1 text-blue-500 hover:text-blue-600 font-semibold">
                                                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 24 24">
                                                            <path d="M5 5l7-3 7 3v16l-7 3-7-3V5z"/>
                                                        </svg>
                                                        Simpan
                                                    </button>
                                                </form>

                                                {{-- Report --}}
                                                <button type="button" class="flex items-center gap-1 text-gray-500 hover:text-gray-600 font-semibold">
                                                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                                    </svg>
                                                    Laporkan
                                                </button>

                                                {{-- Edit & Delete --}}
                                                @if($artwork->user_id === auth()->id())
                                                    <a href="{{ route('member.artworks.edit', $artwork->id) }}" class="flex items-center gap-1 text-green-500 hover:text-green-600 font-semibold">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1-4l4-4"/>
                                                        </svg>
                                                        Edit
                                                    </a>

                                                    <form action="{{ route('member.artworks.destroy', $artwork->id) }}" method="POST" onsubmit="return confirm('Anda yakin ingin menghapus karya ini?');">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="flex items-center gap-1 text-red-500 hover:text-red-600 font-semibold">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                                            </svg>
                                                            Hapus
                                                        </button>
                                                    </form>
                                                @endif
                                            </div>

                                            {{-- Comments Section --}}
                                            <h3 class="font-bold text-xl mt-4 mb-3">Komentar ({{ $artwork->comments->count() }})</h3>
                                            <div class="space-y-3 max-h-60 overflow-y-auto pr-2 mb-4">
                                                @forelse($artwork->comments as $comment)
                                                    <div class="bg-gray-100 p-3 rounded-lg flex justify-between items-start">
                                                        <span class="text-gray-800">
                                                            <span class="font-bold text-sm block">{{ $comment->user->display_name ?? $comment->user->name }}:</span> 
                                                            {{ $comment->content }}
                                                        </span>

                                                        @if(auth()->check() && (
    auth()->user()->role === 'admin' ||  // Admin bisa hapus semua komentar
    $comment->user_id === auth()->id() || // Bisa hapus komentar sendiri
    $artwork->user_id === auth()->id()    // Bisa hapus komentar orang lain di postingannya sendiri
))
    <form action="{{ route('member.artworks.comment.delete', $comment->id) }}" method="POST" class="ml-4 flex-shrink-0">
        @csrf
        @method('DELETE')
        <button type="submit" class="text-red-500 text-xs hover:text-red-700 transition">Hapus</button>
    </form>
@endif

                                                    </div>
                                                @empty
                                                    <p class="text-gray-500 text-center py-4">Belum ada komentar.</p>
                                                @endforelse
                                            </div>

                                            {{-- Form tambah komentar --}}
                                            <form action="{{ route('member.artworks.comment', $artwork->id) }}" method="POST" class="mt-4 flex gap-2">
                                                @csrf
                                                <input type="text" name="content" placeholder="Tulis komentar..." class="w-full border border-gray-300 rounded-full px-4 py-2 focus:ring-blue-500 focus:border-blue-500" required>
                                                <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-full font-semibold transition">Kirim</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col items-center justify-center py-20">
                        <h3 class="text-2xl font-semibold text-gray-900 mb-2">Belum ada karya</h3>
                        <a href="{{ route('member.artworks.create') }}" class="inline-flex items-center gap-2 bg-red-600 hover:bg-red-700 text-white px-8 py-4 rounded-full font-semibold transition-all duration-200 shadow-lg hover:shadow-xl">
                            Unggah Karya Pertama
                        </a>
                    </div>
                @endif
            </div>
        </main> 
    </div> 
</x-app-layout>
