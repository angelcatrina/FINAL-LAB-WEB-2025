<x-app-layout>
   

    <div class="min-h-screen bg-gray-300 py-12">
        <div class="max-w-2xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-700 mb-8 text-center">
                Edit Pengguna
            </h1>

            <div class="bg-gray-800 shadow-xl rounded-2xl p-8">

                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-1">Nama</label>
                        <input type="text" name="name" value="{{ $user->name }}"
                               class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-1">Email</label>
                        <input type="email" name="email" value="{{ $user->email }}"
                               class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="mb-6">
                        <label class="block text-gray-200 font-semibold mb-1">Role</label>
                        <select name="role"
                                class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="member" {{ $user->role === 'member' ? 'selected' : '' }}>Member</option>
                            <option value="curator" {{ $user->role === 'curator' ? 'selected' : '' }}>Curator</option>
                        </select>
                    </div>

                    @if($user->role === 'curator')
                        <div class="mb-6">
                            <label class="block text-gray-200 font-semibold mb-1">Status Kurator</label>
                            <select name="status"
                                    class="w-full bg-gray-700 text-gray-100 border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                                <option value="pending" {{ $user->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="approved" {{ $user->status === 'approved' ? 'selected' : '' }}>Approved</option>
                                <option value="rejected" {{ $user->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                            </select>
                        </div>
                    @endif

 
                    <div class="flex justify-center gap-4 mt-8">
                        <button type="submit"
                                class="px-6 py-2.5 bg-indigo-600 text-white rounded-xl hover:bg-indigo-500 shadow-md transition">
                            Simpan Perubahan
                        </button>

                        <a href="{{ route('admin.users.index') }}"
                           class="px-6 py-2.5 bg-gray-600 text-gray-100 rounded-xl hover:bg-gray-500 shadow-md transition">
                            Batal
                        </a>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
