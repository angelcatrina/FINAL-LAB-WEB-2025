<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    public function index()
    
    
{
    // menampilkan view admin dashboard
    return view('admin.dashboard'); // <-- sesuaikan dengan folder dan file Blade
}
public function statistics()
{
    $totalUsers = \App\Models\User::count();
    $totalArtworks = \App\Models\Artwork::count();
    $totalReports = \App\Models\Report::count();

    return view('admin.statistics', compact('totalUsers', 'totalArtworks', 'totalReports'));
}


}
