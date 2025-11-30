<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Detail Pengguna
        </h2>
    </x-slot>

    
    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

           
            <div class="bg-white shadow-md border border-gray-300 rounded-xl p-8">

                
                <div class="flex justify-center mb-6">
                    @if($user->profile_photo_path)
                        <img src="{{ asset('storage/' . $user->profile_photo_path) }}" 
                             alt="{{ $user->name }}" 

                             
                             class="w-20 h-20 rounded-full object-cover border-2 border-gray-300">
                    @else
                        <div class="w-20 h-20 rounded-full bg-gray-300 flex items-center justify-center text-gray-600 text-3xl font-bold">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                    @endif
                </div>

                
                <h3 class="text-2xl font-semibold text-gray-800 text-center mb-8">
                    Informasi Pengguna
                </h3>

               
                <div class="flex flex-col gap-4">

                   
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="text-sm text-gray-500">Nama</span>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->name }}</p>
                    </div>

                   
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="text-sm text-gray-500">Email</span>
                        <p class="text-lg font-semibold text-gray-800">{{ $user->email }}</p>
                    </div>

                  
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="text-sm text-gray-500">Role</span>
                        <p class="text-lg font-semibold text-gray-800">{{ ucfirst($user->role) }}</p>
                    </div>

                    
                    @if($user->role === 'curator')
                        <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                            <span class="text-sm text-gray-500">Status Kurator</span>
                            <p>
                                <span class="px-3 py-1 text-sm rounded-full
                                    {{ $user->status === 'approved' ? 'bg-green-200 text-green-800' : 'bg-yellow-200 text-yellow-800' }}">
                                    {{ ucfirst($user->status) }}
                                </span>
                            </p>
                        </div>
                    @endif

                    
                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-200">
                        <span class="text-sm text-gray-500">Tanggal Bergabung</span>
                        <p class="text-lg font-semibold text-gray-800">
                            {{ $user->created_at->format('d M Y') }}
                        </p>
                    </div>

                </div>

               
                <div class="mt-8 flex justify-center gap-4">
                    <a href="{{ route('admin.users.index') }}"
                        class="px-5 py-2.5 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-200 transition-colors">
                        Kembali
                    </a>

                    <a href="{{ route('admin.users.edit', $user->id) }}"
                        class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-500 transition-colors">
                        Edit
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
