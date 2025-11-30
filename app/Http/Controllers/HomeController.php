<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Category;
use App\Models\Challenge;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        
        // CHALLENGES – semua challenge
        $challenges = Challenge::latest()->get();

        // Search
        $search = $request->search;

        // Filter by Category
        $category = $request->category;

        // Artworks Query
        $artworks = Artwork::query()
            ->when($search, function ($q) use ($search) {
                $q->where('title', 'like', "%$search%")
                  ->orWhereHas('user', function ($u) use ($search) {
                      $u->where('name', 'like', "%$search%");
                  });
            })
            ->when($category, function ($q) use ($category) {
                $q->where('category_id', $category);
            })
            ->latest()
            ->paginate(20);

        // Featured artworks (random 6)
        $featured = Artwork::inRandomOrder()->take(6)->get();

        // Popular
        $popular = Artwork::latest()->take(10)->get();

        // Newest
        $newest = Artwork::latest()->take(10)->get();

        // Categories
        $categories = Category::all();

        // Active challenges (yang sedang berjalan)
        $activeChallenges = Challenge::where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->latest()
            ->take(3)
            ->get();

            $announcedChallenges = Challenge::where('is_announced', true)
    ->with(['submissions' => function ($q) {
        $q->where('is_winner', true)
          ->orderBy('winner_position');
    }])
    ->get();


       return view('home', compact(
    'artworks',
    'categories',
    'featured',
    'popular',
    'newest',
    'challenges',
    'activeChallenges',
    'announcedChallenges'
));

    }

    
}
