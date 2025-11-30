<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800">
            Upload Karya Baru
        </h2>
    </x-slot>

    <div class="flex justify-center items-center min-h-screen bg-gray-100 p-4">
        <div class="bg-white shadow-lg rounded-xl w-full max-w-lg p-6 sm:p-8 overflow-y-auto">
            <form action="{{ route('member.artworks.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="space-y-4">

                    <div>
                        <label class="block font-semibold mb-1">Judul Karya</label>
                        <input type="text" name="title" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Deskripsi</label>
                        <textarea name="description" required rows="4"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Kategori</label>
                        <select name="category_id" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">File Karya</label>
                        <input type="file" name="file" required
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div>
                        <label class="block font-semibold mb-1">Tags (opsional)</label>
                        <input type="text" name="tags"
                            class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                    </div>

                    <div class="text-right">
                        <button type="submit"
                            class="bg-blue-600 text-white font-semibold px-6 py-2 rounded-lg shadow hover:bg-blue-700 transition">
                            Upload
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</x-app-layout>
