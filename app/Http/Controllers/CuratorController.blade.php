<?php

namespace App\Http\Controllers;

use App\Models\Challenge;
use Illuminate\Http\Request;

class CuratorController extends Controller
{

    public function dashboard()
    {
        $user = auth()->user();
        $challenges = Challenge::where('user_id', $user->id)->get();

        return view('curator.dashboard', compact('challenges'));
    }

    public function pending()
    {
        return view('curator.pending');
    }
}
