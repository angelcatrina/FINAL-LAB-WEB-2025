<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-2xl text-black-100">Admin Dashboard</h2>
    </x-slot>

    
    <div class="min-h-screen bg-gray-900 py-12">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

            
            <p class="text-gray-300 mb-8 text-lg">Halo, Admin! Berikut shortcut untuk mengelola platform.</p>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">

             
                <a href="{{ route('admin.users.index') }}" class="relative p-6 rounded-xl bg-gray-100 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-300 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-800 font-bold text-xl">U</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">User Management</h3>
                    <p class="text-gray-700 text-sm">Melihat, mengedit, dan menghapus data Member & Curator.</p>
                </a>

            
                <a href="{{ route('admin.categories.index') }}" class="relative p-6 rounded-xl bg-gray-700 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-100 font-bold text-xl">C</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-100 mb-2">Category Management</h3>
                    <p class="text-gray-300 text-sm">CRUD untuk semua kategori karya di platform.</p>
                </a>

               
                <a href="{{ route('admin.moderation.queue') }}" class="relative p-6 rounded-xl bg-gray-800 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-600 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-100 font-bold text-xl">M</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-100 mb-2">Content Moderation</h3>
                    <p class="text-gray-300 text-sm">Mengakses Moderation Queue dan memproses laporan.</p>
                </a>

               
                <a href="{{ route('admin.statistics') }}" class="relative p-6 rounded-xl bg-gray-300 shadow-md transform transition-all duration-300 hover:scale-105 hover:shadow-xl">
                    <div class="w-12 h-12 bg-gray-400 rounded-full flex items-center justify-center mb-4">
                        <span class="text-gray-900 font-bold text-xl">S</span>
                    </div>
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">Platform Statistics</h3>
                    <p class="text-gray-700 text-sm">Melihat data statistik platform: pengguna, karya, likes, dan laporan.</p>
                </a>

            </div>
        </div>
    </div>
</x-app-layout>
