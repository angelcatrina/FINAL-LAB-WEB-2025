<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="min-h-screen bg-gray-300 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

 
            <div class="bg-gray-800 shadow-xl rounded-2xl p-8">
                
                <div class="flex justify-center mb-6">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                             alt="{{ $user->name }}" 
                             class="w-28 h-28 rounded-full object-cover border-4 border-gray-600 shadow-lg">
                    @else
                        <div class="w-28 h-28 rounded-full bg-gray-600 flex items-center justify-center text-gray-200 text-4xl font-bold shadow-lg border-4 border-gray-500">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>
                <h3 class="text-2xl font-bold text-gray-100 text-center mb-8">
                    Informasi Pengguna
                </h3>

                <div class="flex flex-col gap-4">

                    <div class="p-4 bg-gray-700 rounded-xl border border-gray-600">
                        <span class="text-sm text-gray-300">Nama</span>
                        <p class="text-lg font-semibold text-gray-100">{{ $user->name }}</p>
                    </div>

                    <div class="p-4 bg-gray-700 rounded-xl border border-gray-600">
                        <span class="text-sm text-gray-300">Email</span>
                        <p class="text-lg font-semibold text-gray-100">{{ $user->email }}</p>
                    </div>

                    <div class="p-4 bg-gray-700 rounded-xl border border-gray-600">
                        <span class="text-sm text-gray-300">Role</span>
                        <p class="text-lg font-semibold text-gray-100">{{ ucfirst($user->role) }}</p>
                    </div>

                    @if($user->role === 'curator')
                        <div class="p-4 bg-gray-700 rounded-xl border border-gray-600 flex items-center justify-between">
                            <span class="text-sm text-gray-300">Status Kurator</span>
                            <span class="px-3 py-1 text-sm font-semibold rounded-full
                                {{ $user->status === 'approved' ? 'bg-green-600 text-green-100' : 'bg-yellow-600 text-yellow-100' }}">
                                {{ ucfirst($user->status) }}
                            </span>
                        </div>
                    @endif

                    <div class="p-4 bg-gray-700 rounded-xl border border-gray-600">
                        <span class="text-sm text-gray-300">Tanggal Bergabung</span>
                        <p class="text-lg font-semibold text-gray-100">
                            {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-6 py-2.5 bg-gray-600 text-gray-100 rounded-xl hover:bg-gray-500 transition-colors shadow-md">
                        Kembali
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-500 transition-colors shadow-md">
                        Edit
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
