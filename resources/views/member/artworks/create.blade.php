<x-app-layout>
    {{-- Header bawaan dihapus sepenuhnya --}}

    <div class="flex flex-col items-center min-h-screen bg-gray-200 p-4">
        
    
        <h1 class="text-4xl font-bold text-gray-800 mb-6">Upload Foto Baru</h1>

        <div class="bg-gray-800 shadow-xl rounded-2xl w-full max-w-lg p-8 sm:p-10 text-white">
            <form action="{{ route('member.artworks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-6">

                    <div>
                        <label class="block font-semibold mb-2 text-gray-200">Judul Karya</label>
                        <input type="text" name="title" required
                               class="w-full bg-gray-300 text-black border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-200">Deskripsi</label>
                        <textarea name="description" required rows="4"
                                  class="w-full bg-gray-300 text-black border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"></textarea>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-200">Kategori</label>
                        <select name="category_id" required
                                class="w-full bg-gray-300 text-black border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-200">File Karya</label>
                        <input type="file" name="file" required
                               class="w-full bg-gray-300 text-black border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div>
                        <label class="block font-semibold mb-2 text-gray-200">Tags (opsional)</label>
                        <input type="text" name="tags"
                               class="w-full bg-gray-300 text-black border border-gray-600 rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="text-right">
                        <button type="submit"
                                class="bg-indigo-600 text-white font-semibold px-6 py-2 rounded-xl shadow-md hover:bg-indigo-500 transition">
                            Upload
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
