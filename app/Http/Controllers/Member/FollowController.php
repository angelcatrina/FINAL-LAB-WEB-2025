<?php

namespace App\Http\Controllers\Member;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class FollowController extends Controller
{
    public function follow(User $user)
    {
        auth()->user()->following()->syncWithoutDetaching([$user->id]);
        return response()->json(['status' => 'success', 'action' => 'followed']);
    }

    public function unfollow(User $user)
    {
        auth()->user()->following()->detach($user->id);
        return response()->json(['status' => 'success', 'action' => 'unfollowed']);
    }
}
