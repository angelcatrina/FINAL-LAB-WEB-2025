<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Artwork;
use App\Models\Favorite;
use App\Models\Like;
use App\Models\Comment;

class InteractionController extends Controller
{
    public function favorite(Artwork $artwork)
    {
        $fav = Favorite::firstOrCreate([
            'user_id' => auth()->id(),
            'artwork_id' => $artwork->id
        ]);

        return back();
    }

     public function like(Artwork $artwork)
    {
        $user = auth()->user();
        $like = $artwork->likes()->where('user_id', $user->id)->first();

        if ($like) {
            $like->delete();
            $isLiked = false;
        } else {
            $artwork->likes()->create(['user_id' => $user->id]);
            $isLiked = true;
        }

        return response()->json(['is_liked' => $isLiked]);
    }

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

    public function deleteComment($commentId)
{
    $comment = \App\Models\Comment::findOrFail($commentId);

    // Pastikan hanya pemilik komentar atau pemilik artwork yang bisa hapus
    if ($comment->user_id === auth()->id() || $comment->artwork->user_id === auth()->id()) {
        $comment->delete();
    }

    return back();
}

    // ===========================
    // Method baru untuk menampilkan favorites
    // ===========================
    public function favorites()
    {
        // Ambil semua favorite milik user, beserta data artwork terkait
        $favorites = auth()->user()->favorites()->with('artwork')->get();

        // Tampilkan view member.favorites
        return view('member.favorites', compact('favorites'));
    }

    public function removeFavorite(Artwork $artwork)
{
    $favorite = Favorite::where('user_id', auth()->id())
                        ->where('artwork_id', $artwork->id)
                        ->first();

    if ($favorite) {
        $favorite->delete();
    }

    return back()->with('success', 'Artwork berhasil dihapus dari favorit.');
}



}
