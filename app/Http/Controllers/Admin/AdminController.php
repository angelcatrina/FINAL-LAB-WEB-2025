<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Artwork;
use App\Models\Report;
use App\Models\Category; // <--- ini wajib!

class AdminController extends Controller
{
    public function statistics()
    {
        $totalUsers = User::count();
        $totalArtworks = Artwork::count();
        $totalReports = Report::count();

        $artworksPerCategory = Category::withCount('artworks')->get();

        return view('admin.statistics', compact(
            'totalUsers',
            'totalArtworks',
            'totalReports',
            'artworksPerCategory'
        ));
    }

}
