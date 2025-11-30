<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    public function create(): View
    {
        return view('auth.login');
    }

  public function store(Request $request)
{
    $request->validate([
        'email' => 'required|string|email',
        'password' => 'required|string',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        $request->session()->regenerate();

        $user = Auth::user();

        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role === 'curator') {
            return redirect()->route('curator.dashboard');
        } else {
            return redirect()->route('member.dashboard');
        }
    }

    return back()->withErrors([
        'email' => 'These credentials do not match our records.',
    ]);
}

  public function destroy(Request $request)
    {
        Auth::guard('web')->logout();  // logout user
        $request->session()->invalidate(); // hapus session
        $request->session()->regenerateToken(); // regenerasi CSRF token

        return redirect('/'); // arahkan ke halaman home setelah logout
    }
}