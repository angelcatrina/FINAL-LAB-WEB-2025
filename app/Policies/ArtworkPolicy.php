<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Artwork;
use Illuminate\Auth\Access\HandlesAuthorization;

class ArtworkPolicy
{
    use HandlesAuthorization;

    public function update(User $user, Artwork $artwork)
    {
        // Hanya owner karya yang boleh update
        return $user->id === $artwork->user_id;
    }

    public function delete(User $user, Artwork $artwork)
    {
        // Hanya owner karya yang boleh delete
        return $user->id === $artwork->user_id;
    }
}
