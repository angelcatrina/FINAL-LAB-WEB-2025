@extends('layouts.app')

@section('content')
<div class="max-w-4xl mx-auto py-10">
    <div class="flex items-center space-x-4">
        <img src="{{ asset('storage/' . $user->avatar_path) }}" class="w-24 h-24 rounded-full object-cover">
        <div>
            <h1 class="text-2xl font-bold">{{ $user->display_name ?? $user->name }}</h1>
            <p class="text-gray-500">{{ $user->bio }}</p>
            <div class="flex space-x-2 mt-2">
                @if($user->instagram_url)
                    <a href="{{ $user->instagram_url }}" target="_blank" class="text-blue-500">Instagram</a>
                @endif
                @if($user->behance_url)
                    <a href="{{ $user->behance_url }}" target="_blank" class="text-blue-500">Behance</a>
                @endif
                @if($user->website_url)
                    <a href="{{ $user->website_url }}" target="_blank" class="text-blue-500">Website</a>
                @endif
            </div>
        </div>
    </div>

    <div class="mt-6 grid grid-cols-1 md:grid-cols-3 gap-4">
        @foreach($artworks as $artwork)
            <div>
                <img src="{{ asset('storage/' . $artwork->file_path) }}" class="w-full h-48 object-cover rounded-md">
                <h3 class="mt-2 font-semibold">{{ $artwork->title }}</h3>
            </div>
        @endforeach
    </div>
</div>
@endsection
