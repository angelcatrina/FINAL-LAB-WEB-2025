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

    public function showFavorite()
    {
        $favorites = Favorite::with('artwork')
                    ->where('user_id', auth()->id())
                    ->get();

        return view('member.favorites', compact('favorites'));
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
        $comment = Comment::findOrFail($commentId);
        $user = auth()->user();

        if ($user->role === 'admin') {
            $comment->delete();
        } 
    
        elseif ($user->role === 'member' || $user->role === 'curator') {
            if ($comment->user_id === $user->id || $comment->artwork->user_id === $user->id) {
                $comment->delete();
            } else {
                abort(403, 'Tidak diizinkan menghapus komentar ini.');
            }
        } 
        else {
            abort(403, 'Tidak diizinkan.');
        }

        return back()->with('success', 'Komentar berhasil dihapus.');
    }

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
