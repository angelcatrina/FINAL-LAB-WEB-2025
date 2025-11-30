<?php

namespace App\Http\Controllers\Curator;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CuratorController extends Controller
{
    public function dashboard()
    {
        return view('curator.dashboard');
    }

    public function pending()
    {
        return view('curator.pending');
    }
}
