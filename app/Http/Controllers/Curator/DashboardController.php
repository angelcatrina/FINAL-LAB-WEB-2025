<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    {
        return view('curator.dashboard'); // atau view lain
    }
}
