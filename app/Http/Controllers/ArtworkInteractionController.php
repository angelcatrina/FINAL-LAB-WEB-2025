<?php

namespace App\Http\Controllers;

use App\Models\Artwork;
use App\Models\Like;
use App\Models\Favorite;
use App\Models\Comment;
use App\Models\Report;
use Illuminate\Http\Request;

class ArtworkInteractionController extends Controller
{
    // LIKE / UNLIKE
    public function toggleLike($id)
    {
        $artwork = Artwork::findOrFail($id);
        $userId = auth()->id();

        $existing = Like::where('user_id', $userId)
                        ->where('artwork_id', $id)
                        ->first();

        if ($existing) {
            $existing->delete(); // UNLIKE
            return back()->with('success', 'Unlike berhasil.');
        }

        Like::create([
            'user_id'   => $userId,
            'artwork_id'=> $id
        ]);

        return back()->with('success', 'Like berhasil.');
    }

    // FAVORITE / UNFAVORITE
    public function toggleFavorite($id)
    {
        $userId = auth()->id();

        $existing = Favorite::where('user_id', $userId)
                            ->where('artwork_id', $id)
                            ->first();

        if ($existing) {
            $existing->delete();
            return back()->with('success', 'Dihapus dari favorit.');
        }

        Favorite::create([
            'user_id' => $userId,
            'artwork_id' => $id
        ]);

        return back()->with('success', 'Ditambahkan ke favorit.');
    }

    // LIHAT FAVORITE USER
    public function showFavorite()
    {
        $favorites = Favorite::with('artwork')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('member.favorites', compact('favorites'));
    }

    // COMMENT
    public function comment(Request $request, Artwork $artwork)
    {
        $request->validate(['content' => 'required|string|max:1000']);

        Comment::create([
            'user_id' => auth()->id(),
            'artwork_id' => $artwork->id,
            'content' => $request->content,
        ]);

        return back();
    }

    // REPORT
    public function report(Request $request, Artwork $artwork)
    {
        $request->validate([
            'reason' => 'required|in:SARA,Plagiat,Konten Tidak Pantas,Lainnya',
        ]);

        Report::create([
            'reporter_id' => auth()->id(),
            'reported_type' => 'artwork',
            'reported_id' => $artwork->id,
            'reason' => $request->reason,
            'details' => $request->details ?? null,
            'status' => 'pending',
        ]);

        return back()->with('success', 'Laporan berhasil dikirim ke admin.');
    }
}
