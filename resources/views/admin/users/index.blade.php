<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-900">Manajemen Pengguna</h2>
    </x-slot>

    
    <div class="min-h-screen py-12 bg-gradient-to-br from-gray-200 via-white to-gray-300">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
         
            <div class="bg-white shadow-md sm:rounded-lg overflow-hidden">
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-300">
                        <thead class="bg-gray-200">
                            <tr>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Nama</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Email</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Role</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Status</th>
                                <th class="px-6 py-3 text-left text-xs font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                            </tr>
                        </thead>

                        <tbody class="bg-white divide-y divide-gray-200">
                            @foreach($users as $u)
                                <tr class="hover:bg-gray-50 transition-colors duration-200">
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-900">{{ $u->name }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ $u->email }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap text-gray-700">{{ ucfirst($u->role) }}</td>
                                    <td class="px-6 py-4 whitespace-nowrap">
                                        @if($u->role === 'curator')
                                            <span class="px-2 py-1 rounded text-sm font-medium 
                                                {{ $u->status === 'approved' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800' }}">
                                                {{ $u->status }}
                                            </span>
                                        @else
                                            <span class="text-gray-400">-</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 whitespace-nowrap flex flex-wrap gap-2">

                                       
                                        <a href="{{ route('admin.users.show', $u) }}" 
                                           class="px-3 py-1 bg-gray-300 text-gray-900 rounded hover:bg-gray-400 transition-colors">
                                            Detail
                                        </a>

                                       
                                        @if($u->role === 'curator' && $u->status === 'pending')
                                            <form method="POST" action="{{ route('admin.users.approve', $u) }}" class="inline">
                                                @csrf @method('PATCH')
                                                <button type="submit" class="px-3 py-1 bg-green-200 text-green-800 rounded hover:bg-green-300 transition-colors">
                                                    Setujui
                                                </button>
                                            </form>
                                        @endif

                                        
                                        @if($u->id !== auth()->id() && $u->role !== 'admin')
                                            <form method="POST" action="{{ route('admin.users.destroy', $u) }}" class="inline">
                                                @csrf @method('DELETE')
                                                <button type="submit" class="px-3 py-1 text-red-600 rounded hover:bg-red-100 transition-colors"
                                                    onclick="return confirm('Hapus pengguna ini?')">
                                                    Hapus
                                                </button>
                                            </form>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                </div>
            </div>

        </div>
    </div>
</x-app-layout>
