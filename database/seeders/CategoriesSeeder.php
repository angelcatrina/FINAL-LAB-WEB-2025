<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategoriesSeeder extends Seeder
{
    public function run(): void
    {
       
        Category::create([
            'id' => 1,
            'name' => 'Digital Art',
        ]);

        Category::create([
            'id' => 2,
            'name' => 'Fotografi',
        ]);

        Category::create([
            'id' => 3,
            'name' => 'Alam',
        ]);
    }
}
