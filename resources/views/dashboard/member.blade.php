<x-app-layout>
    <div class="py-6">
        <h2 class="text-2xl font-bold">Dashboard Member</h2>
        <p>Selamat datang, {{ auth()->user()->name }}</p>
    </div>
</x-app-layout>
