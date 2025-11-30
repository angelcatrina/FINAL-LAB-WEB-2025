<x-app-layout>
    <div class="min-h-screen bg-gray-100 py-8">
        <div class="max-w-5xl mx-auto px-4 sm:px-6 lg:px-8">

            <!-- Card Profil Pengguna -->
            <div class="bg-white shadow-md rounded-xl p-6">

                <!-- Header Profil -->
                <div class="flex flex-col sm:flex-row items-center sm:items-start gap-6">
                    
                    <!-- Avatar -->
                    <img src="{{ $user->avatar_path ? asset('storage/' . $user->avatar_path) : 'https://ui-avatars.com/api/?name=' . urlencode($user->name) }}"
                         alt="{{ $user->name }}"
                         class="w-28 h-28 rounded-full object-cover border border-gray-300">

                    <!-- Info Profil -->
                    <div class="flex-1 flex flex-col">
                        <div class="flex items-center gap-3">
                            <h1 class="text-2xl font-bold text-gray-800">{{ $user->display_name ?: $user->name }}</h1>

@if(auth()->check() && auth()->id() !== $user->id)
    <div x-data="{
        isFollowing: {{ optional(auth()->user())->isFollowing($user) ? 'true' : 'false' }},
        toggleFollow() {
            fetch(this.isFollowing 
                ? '{{ route('member.unfollow', $user->id) }}'
                : '{{ route('member.follow', $user->id) }}', {
                method: 'POST',
                headers: { 'X-CSRF-TOKEN': '{{ csrf_token() }}' }
            }).then(() => { this.isFollowing = !this.isFollowing })
        }
    }">
                                    <button 
            @click="toggleFollow()"
            :class="isFollowing ? 'bg-gray-200 text-gray-700' : 'bg-blue-600 text-white'"
            class="px-3 py-1 rounded hover:opacity-90 text-sm transition">
            <span x-text="isFollowing ? 'Unfollow' : 'Follow'"></span>
        </button>
    </div>
@endif
                        </div>

                        <!-- Bio -->
                        @if($user->bio)
                            <p class="text-gray-600 mt-2">{{ $user->bio }}</p>
                        @endif

                        <!-- Sosial Media -->
                        <div class="mt-2 flex gap-3 text-sm">
                            @if($user->website_url)
                                <a href="{{ $user->website_url }}" target="_blank" class="text-blue-600 hover:underline">Website</a>
                            @endif
                            @if($user->instagram_url)
                                <a href="{{ $user->instagram_url }}" target="_blank" class="text-pink-600 hover:underline">Instagram</a>
                            @endif
                            @if($user->behance_url)
                                <a href="{{ $user->behance_url }}" target="_blank" class="text-blue-800 hover:underline">Behance</a>
                            @endif
                        </div>
                    </div>
                </div>

                <!-- Karya Pengguna -->
                <div class="mt-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-4">Karya oleh {{ $user->name }}</h2>

                    @if($artworks->count())
                        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                            @foreach($artworks as $art)
                                <a href="{{ route('artworks.show', $art) }}">
                                    <img src="{{ asset('storage/' . $art->file_path) }}" 
                                         alt="{{ $art->title }}" 
                                         class="w-full h-32 object-cover rounded-lg border border-gray-200 hover:scale-105 transition">
                                </a>
                            @endforeach
                        </div>

                        <!-- Pagination -->
                        <div class="mt-4">
                            {{ $artworks->links() }}
                        </div>
                    @else
                        <p class="text-gray-500 italic mt-4">Belum ada karya.</p>
                    @endif
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
