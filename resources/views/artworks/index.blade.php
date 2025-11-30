@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto py-6">
    <h1 class="text-2xl font-bold mb-4">Gallery Karya</h1>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($artworks as $artwork)
            <a href="{{ route('artworks.show', $artwork->id) }}">
                <img src="{{ asset('storage/' . $artwork->file_path) }}" 
                     alt="{{ $artwork->title }}" 
                     class="w-full h-48 object-cover rounded-lg hover:opacity-80 transition">
            </a>
        @endforeach
    </div>
</div>
@endsection
