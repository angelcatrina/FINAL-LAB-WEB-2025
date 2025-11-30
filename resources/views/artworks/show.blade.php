<x-app-layout>
    @if (session('success'))
        <div class="max-w-4xl mx-auto px-6 lg:px-8 pt-6">
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <strong class="font-bold">Berhasil!</strong>
                <span class="block sm:inline">{{ session('success') }}</span>
                <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                    {{-- Tombol close sederhana --}}
                </span>
            </div>
        </div>
    @endif
    
    <div class="py-6">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg overflow-hidden">
                <div class="md:flex">
                    <div class="md:w-2/3 p-6">
                        <img src="{{ asset('storage/' . $artwork->file_path) }}" 
                             alt="{{ $artwork->title }}" 
                             class="w-full rounded-lg object-cover h-96">
                    </div>
                    <div class="md:w-1/3 p-6 border-l">
                        <h1 class="text-2xl font-bold">{{ $artwork->title }}</h1>
                        <p class="mt-2 text-gray-600">{{ $artwork->description }}</p>
                        
                        <div class="mt-4 text-sm">
                            <span class="font-medium">Kategori:</span> {{ $artwork->category->name }}
                        </div>
                        <div class="mt-2 text-sm">
                            <span class="font-medium">Dibuat oleh:</span> 
                            <a href="{{ route('profile.show', $artwork->user) }}" class="text-blue-600 hover:underline">
                                {{ $artwork->user->name }}
                            </a>
                        </div>
                        <div class="mt-2 text-xs text-gray-500">
                            {{ $artwork->created_at->format('d M Y') }}
                        </div>

                       {{-- Like / Favorite / Report --}}
<div class="mt-4">
    @auth
        @if(auth()->user()->role === 'member')
            @php
                $isLiked = $artwork->likes()->where('user_id', auth()->id())->exists();
               
            @endphp

            {{-- Like / Unlike Button --}}
            <button onclick="toggleLike({{ $artwork->id }})"
                    id="like-btn-{{ $artwork->id }}"
                    class="px-3 py-1 rounded font-semibold
                           {{ $isLiked ? 'bg-red-100 text-red-600' : 'bg-gray-200 text-gray-700' }}">
                {{ $isLiked ? 'Unlike' : 'Like' }}
            </button>

            {{-- Favorite / Unsave --}}
            <form method="POST" action="{{ route('member.artworks.favorite', $artwork) }}" class="inline">
                @csrf
                @if($isFavorite)
                    @method('DELETE')
                @endif
                <button type="submit" class="px-3 py-1 bg-gray-200 rounded hover:bg-gray-300">
                    {{ $isFavorite ? 'Unsave' : 'Simpan' }}
                </button>
            </form>

            {{-- Report --}}
            <button onclick="document.getElementById('report-form').classList.toggle('hidden')"
                    class="px-3 py-1 bg-red-100 text-red-600 rounded hover:bg-red-200 text-sm">
                Laporkan
            </button>

            <div id="report-form" class="mt-4 hidden">
                <form method="POST" action="{{ route('member.artworks.report', $artwork) }}">
                    @csrf
                    <select name="reason" class="w-full mb-2 border rounded p-2" required>
                        <option value="">-- Pilih Alasan --</option>
                        <option value="SARA">SARA</option>
                        <option value="Plagiat">Plagiat</option>
                        <option value="Konten Tidak Pantas">Konten Tidak Pantas</option>
                        <option value="Lainnya">Lainnya</option>
                    </select>
                    <button type="submit" class="mt-2 bg-red-600 text-white px-3 py-1 rounded">Kirim Laporan</button>
                </form>
            </div>
        @endif
    @endauth

    @guest
        <div class="mt-6 text-sm text-gray-500">
            <p>Login sebagai Member untuk menyukai, menyimpan, atau melaporkan karya ini.</p>
            <a href="{{ route('login') }}" class="text-blue-600 hover:underline">Login</a>
        </div>
    @endguest
</div>

{{-- AJAX Script --}}
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
       
        likeBtn.textContent = data.is_liked ? 'Unlike' : 'Like';

        
        if(data.is_liked){
            likeBtn.classList.remove('bg-gray-200', 'text-gray-700');
            likeBtn.classList.add('bg-red-100', 'text-red-600');
        } else {
            likeBtn.classList.remove('bg-red-100', 'text-red-600');
            likeBtn.classList.add('bg-gray-200', 'text-gray-700');
        }
    })
    .catch(err => console.error(err));
}
</script>


                        <div class="mt-8">
                            <h3 class="font-semibold">Komentar ({{ $artwork->comments->count() }})</h3>
                            @foreach($artwork->comments as $comment)
                                <div class="mt-3 p-3 bg-gray-50 rounded">
                                    <div class="font-medium text-sm">{{ $comment->user->name }}</div>
                                    <div class="text-sm">{{ $comment->content }}</div>
                                </div>
                            @endforeach

                            @auth
                                @if(auth()->user()->role === 'member')
                                    <form method="POST" action="{{ route('member.artworks.comment', $artwork)}}" class="mt-4">
                                        @csrf
                                        <textarea name="content" rows="2" class="w-full border rounded p-2" placeholder="Tulis komentar..." required></textarea>
                                        <button type="submit" class="mt-2 bg-blue-600 text-white px-3 py-1 rounded">Kirim</button>
                                    </form>
                                @endif
                            @endauth
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>