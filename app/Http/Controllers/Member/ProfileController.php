<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = auth()->user();
        return view('member.profile.edit', compact('user'));
    }

    public function update(Request $request)
{
    $user = auth()->user();

    $request->validate([
        'display_name' => 'required|string|max:255',
        'bio' => 'nullable|string|max:500',
        'avatar_path' => 'nullable|image|max:2048',
        'website_url' => 'nullable|url',
        'instagram_url' => 'nullable|url',
        'behance_url' => 'nullable|url',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|string|min:8|confirmed',
    ]);

    $data = $request->only('display_name', 'bio', 'website_url', 'instagram_url', 'behance_url', 'email');

    if($request->hasFile('avatar_path')){
        $data['avatar_path'] = $request->file('avatar_path')->store('profile_photos','public');
    }

    if($request->password){
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return back()->with('success', 'Profil berhasil diperbarui.');
}
}