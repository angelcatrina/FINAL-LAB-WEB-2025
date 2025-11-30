<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Favorite;
use App\Models\ChallengeSubmission;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        
        // My Artworks
        $artworks = Artwork::where('user_id', $user->id)
                        ->latest()
                        ->get();

        // My Favorites
        $favorites = Favorite::with('artwork')
                        ->where('user_id', $user->id)
                        ->get();

        // My Submissions (Challenge)
        $submissions = ChallengeSubmission::with('challenge', 'artwork')
                            ->where('user_id', $user->id)
                            ->latest()
                            ->get();

       return view('member.dashboard', compact('artworks', 'favorites', 'submissions'));
    }
}
