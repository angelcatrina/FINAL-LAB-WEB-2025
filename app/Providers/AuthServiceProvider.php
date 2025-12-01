<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Artwork;
use App\Policies\ArtworkPolicy;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Artwork::class => ArtworkPolicy::class,
    ];

    
    public function boot(): void
    {
        $this->registerPolicies();
    }
}
