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
        // Contoh data
        Artwork::create([
            'title' => 'Lukisan Senja',
            'description' => 'Karya digital warna senja',
            'file_path' => 'senja.jpg', // nanti harus ada di storage/app/public
            'user_id' => 1, // pastikan user dengan id=1 ada
            'category_id' => 1, // pastikan category dengan id=1 ada
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
