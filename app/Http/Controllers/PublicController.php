<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Challenge;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;

class PublicController extends Controller
{
public function index(Request $request)
{
    $query = Artwork::with(['user', 'category'])->latest();

    // Filter kategori
    if ($request->filled('category')) {
        $query->where('category_id', $request->category);
    }

    // Search berdasarkan judul atau nama kreator
    if ($request->filled('search')) {
        $search = $request->search;
        $query->where(function ($q) use ($search) {
            $q->where('title', 'like', "%{$search}%")
              ->orWhereHas('user', fn($u) => $u->where('name', 'like', "%{$search}%"));
        });
    }

    $artworks = $query->paginate(12);
    $categories = Category::all();
    $activeChallenges = Challenge::where('start_date', '<=', now())
                                ->where('end_date', '>=', now())
                                ->latest()
                                ->take(3)
                                ->get();

    return view('home', compact('artworks', 'categories', 'activeChallenges'));
}


    public function show(Artwork $artwork)
{
    $artwork->load('category', 'user', 'comments.user', 'likes', 'favorites'); // eager load untuk efisiensi
    return view('artworks.show', compact('artwork'));
}



          public function profile(User $user)
    {
        $artworks = $user->artworks()->with('category')->latest()->paginate(12);
        return view('profile.show', compact('user', 'artworks'));
    }

    public function challengeShow(Challenge $challenge)
{
    $submissions = $challenge->submissions()->with('artwork.user')->get();
    $winners = $submissions->filter(fn($s) => $s->is_winner);

    return view('challenges.show', compact('challenge', 'submissions', 'winners'));
}
    
}