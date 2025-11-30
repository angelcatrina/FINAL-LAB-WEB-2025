<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's route middleware.
     *
     * @var array
     */
  
protected $routeMiddleware = [
    'auth' => \App\Http\Middleware\Authenticate::class,
    'member' => \App\Http\Middleware\Member::class,
    'curator' => \App\Http\Middleware\Curator::class,
    'admin' => \App\Http\Middleware\Admin::class,
];


}
