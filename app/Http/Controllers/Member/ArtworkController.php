<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use App\Models\Artwork;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArtworkController extends Controller
{
    public function index()
    {
        $artworks = auth()->user()->artworks()->with('category')->latest()->get();
        return view('member.dashboard', compact('artworks'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('member.artworks.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'tags' => 'nullable|string',
        ]);

         $filePath = $request->file('file')->store('artworks', 'public');

 $artwork = Artwork::create([
        'user_id' => auth()->id(),
        'category_id' => $request->category_id,
        'title' => $request->title,
        'description' => $request->description,
        'file_path' => $filePath, // contoh: artworks/nama_file.jpg
        'tags' => $request->tags,
    ]);

    return redirect()->route('member.dashboard')->with('success', 'Karya berhasil diunggah!');
}

    public function edit(Artwork $artwork)
    {
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }
        $categories = Category::all();
        return view('member.artworks.edit', compact('artwork', 'categories'));
    }

    public function update(Request $request, Artwork $artwork)
    {
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'file' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
            'tags' => 'nullable|string',
        ]);

        $data = $request->only(['title', 'description', 'category_id', 'tags']);

        if ($request->hasFile('file')) {
            if ($artwork->file_path) {
                Storage::delete('public/' . $artwork->file_path);
            }
            $path = $request->file('file')->store('public/artworks');
            $data['file_path'] = str_replace('public/', '', $path);
        }

        $artwork->update($data);

        return redirect()->route('member.dashboard')->with('success', 'Karya berhasil diperbarui!');
    }
public function save(Artwork $artwork)
{
    // Contoh logika Save, misal relasi many-to-many dengan user
    auth()->user()->savedArtworks()->syncWithoutDetaching($artwork->id);

    return back()->with('success', 'Karya berhasil disimpan!');
}

    
    public function destroy(Artwork $artwork)
    {
        if ($artwork->user_id !== auth()->id()) {
            abort(403);
        }

        if ($artwork->file_path) {
            Storage::delete('public/' . $artwork->file_path);
        }

        $artwork->delete();

        return redirect()->route('member.artworks.index')->with('success', 'Karya berhasil dihapus!');
    }

    public function report()
{
    // Misal return view report
    return view('member.artworks.report');
}


public function show($id)
{
    $artwork = Artwork::with('category', 'user')->findOrFail($id);

    return view('artwork.detail', compact('artwork'));
}

// Tambahkan method submissions() di sini
    public function submissions()
    {
        // Ambil semua artworks yang pernah di-submit ke challenge oleh user
        $submissions = auth()->user()
                        ->artworks()
                        ->whereHas('submissions') // Hanya artworks yang pernah di-submit
                        ->with('submissions.challenge')
                        ->latest()
                        ->get();

        return view('member.artworks.submissions', compact('submissions'));
    }


//     public function like($id)
// {
//     $artwork = Artwork::findOrFail($id);

//     $artwork->likes()->firstOrCreate([
//         'user_id' => auth()->id()
//     ]);

//     return back()->with('success', 'Berhasil menyukai karya');
// }

// public function unlike($id)
// {
//     $artwork = Artwork::findOrFail($id);

//     $artwork->likes()->where('user_id', auth()->id())->delete();

//     return back()->with('success', 'Berhasil menghapus like');
// }

public function like($id)
{
    $artwork = Artwork::findOrFail($id);

    $artwork->likes_count = ($artwork->likes_count ?? 0) + 1;
    $artwork->save();

    return back()->with('success', 'Berhasil menambahkan like!');
}

}