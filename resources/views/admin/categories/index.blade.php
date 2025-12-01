<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="min-h-screen bg-gray-200 py-12">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8">

            <h1 class="text-3xl font-bold text-gray-800 mb-8 text-center">
                Daftar Kategori
            </h1>

            <div class="bg-white shadow-xl rounded-2xl p-6">

                <div class="flex justify-end mb-6">
                    <a href="{{ route('admin.categories.create') }}" 
                       class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-xl shadow-md transition">
                        + Tambah Kategori
                    </a>
                </div>

                @if(session('success'))
                    <div class="mb-4 p-4 bg-green-100 border-l-4 border-green-500 text-green-800 rounded shadow">
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
                                    <tr class="hover:bg-gray-50 transition-colors">
                                        <td class="px-6 py-4 text-gray-800 font-medium">{{ $cat->name }}</td>
                                        <td class="px-6 py-4 flex gap-4">
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
                    <p class="text-gray-500 italic mt-4 text-center">Belum ada kategori.</p>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>
