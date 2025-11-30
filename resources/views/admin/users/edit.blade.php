<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">
            Edit Pengguna
        </h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <div class="bg-white shadow-md border border-gray-300 rounded-xl p-8">

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                  
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-1">Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                               class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                   
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-1">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                               class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                    </div>

                 
                    <div class="mb-6">
                        <label class="block text-gray-700 font-semibold mb-1">Role</label>
                        <select name="role"
                                class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                            <option value="member" {{ $user->role === 'member' ? 'selected' : '' }}>Member</option>
                            <option value="curator" {{ $user->role === 'curator' ? 'selected' : '' }}>Curator</option>
                        </select>
                    </div>

                  
                    @if($user->role === 'curator')
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-1">Status Kurator</label>
                            <select name="status"
                                    class="w-full bg-gray-50 text-gray-800 border border-gray-300 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
                                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $user->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $user->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    @endif

                    
                    <div class="flex justify-center gap-4 mt-8">
                        <button type="submit"
                                class="px-5 py-2.5 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.users.index') }}"
                           class="px-5 py-2.5 bg-gray-300 text-gray-800 rounded-lg hover:bg-gray-200 transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
