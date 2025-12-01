<x-app-layout>
    {{-- Header bawaan tetap dihapus untuk menghindari background putih --}}
    
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-100 mb-8 text-center">
                Manajemen Pengguna
            </h1>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                
                @foreach($users as $u)
                    <div class="bg-gray-800 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 overflow-hidden border border-gray-700">
                        
                        <div class="bg-gray-700 h-24 relative">
                            <div class="absolute -bottom-12 left-1/2 transform -translate-x-1/2">
                                <div class="w-24 h-24 bg-gray-800 rounded-full shadow flex items-center justify-center border-4 border-gray-700 overflow-hidden">
                                    @if($u->avatar && file_exists(storage_path('app/public/avatars/' . $u->avatar)))
                                        <img src="{{ asset('storage/avatars/' . $u->avatar) }}" 
                                             alt="{{ $u->name }}" 
                                             class="w-full h-full object-cover">
                                    @else
                                        <span class="text-4xl font-bold text-gray-200">
                                            {{ strtoupper(substr($u->name, 0, 1)) }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="pt-16 pb-6 px-6">

                            <h3 class="text-xl font-bold text-gray-100 text-center mb-1">
                                {{ $u->name }}
                            </h3>

                            <p class="text-sm text-gray-400 text-center mb-4 truncate">
                                {{ $u->email }}
                            </p>

                            <div class="flex justify-center mb-3">
                                <span class="px-4 py-1 rounded-full text-xs font-semibold uppercase tracking-wide
                                    {{ $u->role === 'admin' ? 'bg-red-700 text-red-100' : ($u->role === 'curator' ? 'bg-indigo-700 text-indigo-100' : 'bg-gray-600 text-gray-200') }}">
                                    {{ ucfirst($u->role) }}
                                </span>
                            </div>

                            <div class="flex justify-center mb-6">
                                @if($u->role === 'curator')
                                    <span class="px-4 py-1 rounded-full text-sm font-medium
                                        {{ $u->status === 'approved' ? 'bg-green-700 text-green-100' : 'bg-yellow-700 text-yellow-100' }}">
                                        <span class="inline-block w-2 h-2 rounded-full mr-2
                                            {{ $u->status === 'approved' ? 'bg-green-400' : 'bg-yellow-400' }}"></span>
                                        {{ ucfirst($u->status) }}
                                    </span>
                                @else
                                    <span class="text-gray-500 text-sm">No Status</span>
                                @endif
                            </div>

 
                            <hr class="my-4 border-gray-600">
                            <div class="space-y-2">
                                <a href="{{ route('admin.users.show', $u) }}" 
                                   class="block w-full px-4 py-2 bg-gray-600 text-gray-100 text-center rounded-lg hover:bg-gray-500 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                                    Detail
                                </a>
                                @if($u->role === 'curator' && $u->status === 'pending')
                                    <form method="POST" action="{{ route('admin.users.approve', $u) }}">
                                        @csrf @method('PATCH')
                                        <button type="submit" 
                                                class="block w-full px-4 py-2 bg-green-600 text-green-100 text-center rounded-lg hover:bg-green-500 transition-all duration-200 font-medium shadow-md hover:shadow-lg">
                                            Setujui
                                        </button>
                                    </form>
                                @endif
                                @if($u->id !== auth()->id() && $u->role !== 'admin')
                                    <form method="POST" action="{{ route('admin.users.destroy', $u) }}">
                                        @csrf @method('DELETE')
                                        <button type="submit" 
                                                onclick="return confirm('Hapus pengguna ini?')"
                                                class="block w-full px-4 py-2 bg-gray-800 border-2 border-red-600 text-red-400 text-center rounded-lg hover:bg-red-900 hover:border-red-500 transition-all duration-200 font-medium">
                                            Hapus
                                        </button>
                                    </form>
                                @endif

                            </div>

                        </div>
                    </div>
                @endforeach

            </div>

        </div>
    </div>
</x-app-layout>
