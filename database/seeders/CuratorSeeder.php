<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class CuratorSeeder extends Seeder
{
    public function run(): void
    {
        // Cek dulu apakah user sudah ada
        if (!User::where('email', 'curator@angel.com')->exists()) {
            User::create([
                'name' => 'Angel Curator',
                'email' => 'curator@angel.com',
                'password' => Hash::make('curator123'),
                'role' => 'curator',
                'status' => 'active',
            ]);
        }
    }
}
