<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        $users = User::where('role', '!=', 'admin')
                      ->orWhere('id', auth()->id())
                      ->latest()
                      ->get();
        return view('admin.users.index', compact('users'));
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            return back()->withErrors('Tidak bisa menghapus akun sendiri.');
        }

        if ($user->avatar_path) {
            Storage::delete('public/' . $user->avatar_path);
        }

        $user->delete();
        return back()->with('success', 'Pengguna berhasil dihapus.');
    }

    public function approve(User $user)
{
    if ($user->role !== 'curator') {
        return back()->with('error', 'User ini bukan curator.');
    }

    $user->status = 'approved';
    $user->save();

    return back()->with('success', 'Curator berhasil disetujui!');
}
public function show(User $user)
{
    return view('admin.users.show', compact('user'));
}

public function edit(\App\Models\User $user)
{
    return view('admin.users.edit', compact('user'));
}
public function update(Request $request, \App\Models\User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'role' => 'required|in:member,curator,admin',
        'status' => 'nullable|in:pending,approved,rejected'
    ]);

    $user->update($request->only('name', 'email', 'role', 'status'));

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'Data pengguna berhasil diperbarui!');
}
}