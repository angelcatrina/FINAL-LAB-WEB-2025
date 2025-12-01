<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;
use App\Models\Challenge;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChallengeController extends Controller
{
    public function index()
    {
        $challenges = auth()->user()->challenges()->latest()->get();
        return view('curator.challenges.index', compact('challenges'));
    }

    public function create()
    {
        return view('curator.challenges.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rules' => 'required|string',
            'prize' => 'nullable|string',
            'start_date' => 'required|date|after_or_equal:today',
            'end_date' => 'required|date|after:start_date',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'curator_id' => auth()->id(),
            'title' => $request->title,
            'description' => $request->description,
            'rules' => $request->rules,
            'prize' => $request->prize,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->hasFile('banner')) {
            $path = $request->file('banner')->store('public/challenges');
            $data['banner_path'] = str_replace('public/', '', $path);
        }

        Challenge::create($data);

        return redirect()->route('curator.challenges.index')->with('success', 'Challenge berhasil dibuat!');
    }

    public function edit(Challenge $challenge)
    {
        if ($challenge->curator_id !== auth()->id()) {
            abort(403);
        }
        return view('curator.challenges.edit', compact('challenge'));
    }

    public function update(Request $request, Challenge $challenge)
    {
        if ($challenge->curator_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'rules' => 'required|string',
            'prize' => 'nullable|string',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'banner' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $data = [
            'title' => $request->title,
            'description' => $request->description,
            'rules' => $request->rules,
            'prize' => $request->prize,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ];

        if ($request->hasFile('banner')) {
            if ($challenge->banner_path) {
                Storage::delete('public/' . $challenge->banner_path);
            }
            $path = $request->file('banner')->store('public/challenges');
            $data['banner_path'] = str_replace('public/', '', $path);
        }

        $challenge->update($data);

        return redirect()->route('curator.challenges.index')->with('success', 'Challenge berhasil diperbarui!');
    }

    public function destroy(Challenge $challenge)
    {
        if ($challenge->curator_id !== auth()->id()) {
            abort(403);
        }

        if ($challenge->banner_path) {
            Storage::delete('public/' . $challenge->banner_path);
        }

        $challenge->delete();

        return back()->with('success', 'Challenge dihapus.');
    }

public function selectWinners(Challenge $challenge)
{
    if ($challenge->curator_id !== auth()->id()) {
        abort(403, 'Tidak diizinkan');
    }

    if (now()->lt($challenge->end_date)) {
        return redirect()->back()->withErrors('Challenge belum berakhir.');
    }

    
    $submissions = $challenge->submissions()->with('artwork.user')->get();
    return view('curator.challenges.winners', compact('challenge', 'submissions'));
}

    public function storeWinners(Request $request, Challenge $challenge)
    {
        if ($challenge->curator_id !== auth()->id()) {
            abort(403, 'Tidak diizinkan');
        }
        if (now()->lt($challenge->end_date)) {
            abort(403, 'Challenge belum berakhir');
        }

        $winners = $request->input('winners', []);
        $challenge->submissions()->update(['is_winner' => false, 'winner_position' => null]);

        foreach ($winners as $submissionId => $position) {
            if (in_array($position, ['1st', '2nd', '3rd'])) {
                $challenge->submissions()
                    ->where('id', $submissionId)
                    ->update([
                        'is_winner' => true,
                        'winner_position' => $position
                    ]);
            }
        }

        return redirect()->route('challenges.show', $challenge)
                         ->with('success', 'Pemenang berhasil diumumkan!');
    }

   public function announceWinners(Challenge $challenge)
{
    $challenge->is_announced = true;
    $challenge->save();

    
    $challenge->submissions()
              ->whereNotNull('winner_position')
              ->update(['is_winner' => true]);

    return redirect()->back()->with('success', 'Pemenang berhasil diumumkan!');
}


public function show(Challenge $challenge)
{
    
    $submissions = $challenge->submissions()->with('artwork.user')->get();

   
    $winners = $submissions->where('is_winner', true)->sortBy('winner_position');

    return view('challenges.show', compact('challenge', 'submissions', 'winners'));
}


}

