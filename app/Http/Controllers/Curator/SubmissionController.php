<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Submission;

class SubmissionController extends Controller
{
    public function index()
    {
        $submissions = Submission::with('challenge', 'artwork.user')->latest()->get();
        return view('curator.submissions.index', compact('submissions'));

        $submissions = Submission::latest()->get();

    $announcedChallenges = Challenge::where('is_announced', true)
        ->with(['submissions' => function ($q) {
            $q->where('is_winner', true)
              ->orderBy('winner_position');
        }])
        ->get();

    return view('curator.submissions.index', compact('submissions', 'announcedChallenges'));
    }

public function setWinner(Request $request, Submission $submission)
{
    $request->validate([
        'winner_position' => 'required|integer|min:1',
    ]);

    
    Submission::where('challenge_id', $submission->challenge_id)
              ->where('winner_position', $request->winner_position)
              ->update(['winner_position' => null]);

   
    $submission->update([
        'winner_position' => $request->winner_position,
    ]);

    return redirect()->back()->with('success', 'Posisi juara berhasil disimpan sementara.');
}


}
