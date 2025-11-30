<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-gray-800">Manajemen Kategori</h2>
    </x-slot>

    <div class="min-h-screen bg-gray-100 py-10">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <div class="bg-white shadow-md border border-gray-300 rounded-xl p-6">

             
                <div class="flex justify-between items-center mb-6">
                    <h3 class="text-lg font-semibold text-gray-800">Daftar Kategori</h3>
                    <a href="{{ route('admin.categories.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg shadow transition">
                        + Tambah Kategori
                    </a>
                </div>

           
                @if(session('success'))
                    <div class="mb-4 p-3 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow">
                        {{ session('success') }}
                    </div>
                @endif

         
                @if($categories->count())
                    <div class="overflow-x-auto">
                        <table class="min-w-full bg-gray-50 divide-y divide-gray-200 rounded-lg shadow">
                            <thead class="bg-gray-100">
                                <tr>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Nama Kategori</th>
                                    <th class="px-6 py-3 text-left text-sm font-medium text-gray-700 uppercase tracking-wider">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($categories as $cat)
                                    <tr class="hover:bg-gray-100 transition-colors">
                                        <td class="px-6 py-4 text-gray-800">{{ $cat->name }}</td>
                                        <td class="px-6 py-4 flex gap-3">
                                            <a href="{{ route('admin.categories.edit', $cat) }}" 
                                               class="text-blue-600 hover:text-blue-800 font-semibold transition">
                                                Edit
                                            </a>
                                            <form method="POST" action="{{ route('admin.categories.destroy', $cat) }}" 
                                                  onsubmit="return confirm('Hapus kategori ini?')">
                                                @csrf @method('DELETE')
                                                <button type="submit" 
                                                        class="text-red-600 hover:text-red-800 font-semibold transition">
                                                    Hapus
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <p class="text-gray-500 italic mt-4">Belum ada kategori.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
