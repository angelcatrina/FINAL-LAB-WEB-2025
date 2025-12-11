<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artwork;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ArtworkSeeder extends Seeder
{
    public function run()
    {
        
        Artwork::create([
            'title' => 'Lukisan Senja',
            'description' => 'Karya digital warna senja',
            'file_path' => 'senja.jpg', 
            'user_id' => 1, 
            'category_id' => 1, 
            'tags' => 'senja,digital',
        ]);

        Artwork::create([
            'title' => 'Fotografi Alam',
            'description' => 'Foto alam yang indah',
            'file_path' => 'alam.jpg',
           'user_id' => 1,
            'category_id' => 3,
            'tags' => 'foto,alam,nature',
        ]);
    }
}
