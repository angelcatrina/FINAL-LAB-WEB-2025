<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use App\Models\Artwork;
use Illuminate\Http\Request;
use App\Models\Submission;
use Illuminate\Support\Facades\Auth;

class ChallengeSubmissionController extends Controller
{
    // Daftar challenge aktif
    public function index()
    {
        $activeChallenges = Challenge::where('end_date', '>=', now())
                                     ->orderBy('end_date', 'asc')
                                     ->get();

        return view('challenges.index', compact('activeChallenges'));
    }

    // Form submit karya
    public function create(Challenge $challenge)
    {
        if (now()->gt($challenge->end_date)) {
            return redirect()->back()->withErrors('Challenge sudah berakhir.');
        }

        $submittedArtworkIds = $challenge->submissions->pluck('artwork_id');
        $availableArtworks = auth()->user()->artworks()
            ->whereNotIn('id', $submittedArtworkIds)
            ->get();

        return view('challenges.submit', compact('challenge', 'availableArtworks'));
    }

    // Simpan submission karya
    public function store(Request $request, Challenge $challenge)
    {
        if (now()->gt($challenge->end_date)) {
            return redirect()->back()->withErrors('Challenge sudah berakhir.');
        }

        // Validasi input
        $request->validate([
            'artwork_id' => 'required|exists:artworks,id',
        ]);

        $artwork = Artwork::findOrFail($request->artwork_id);

        // Pastikan karya milik user
        if ($artwork->user_id !== Auth::id()) {
            abort(403, 'Karya bukan milik Anda.');
        }

        // Cek duplikasi submission
        if ($challenge->submissions()->where('artwork_id', $artwork->id)->exists()) {
            return redirect()->back()->withErrors('Karya ini sudah di-submit.');
        }

        // Simpan submission
        $challenge->submissions()->create([
            'artwork_id' => $artwork->id,
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('challenges.show', $challenge)
                         ->with('success', 'Karya berhasil di-submit ke challenge!');
    }

    // Lihat detail challenge + galeri + pemenang
    public function show(Challenge $challenge)
    {
        $challenge->load(['submissions.artwork.user']); // eager load
        $submissions = $challenge->submissions;
        $winners = $submissions->filter(fn($s) => $s->is_winner ?? false);

        return view('challenges.show', compact('challenge', 'submissions', 'winners'));
    }
}
