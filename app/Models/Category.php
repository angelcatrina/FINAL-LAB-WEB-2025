<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'description',
    ];
    public function statistics()
{
    $totalUsers = User::count();
    $totalArtworks = Artwork::count();
    $totalReports = Report::count();

    
    $artworksPerCategory = Category::withCount('artworks')->get();
    
    return view('admin.statistics', compact('totalUsers', 'totalArtworks', 'totalReports', 'artworksPerCategory'));
}
 public function artworks()
    {
        return $this->hasMany(Artwork::class);
    }
}
