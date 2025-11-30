<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

DB::table('users')->insert([
    'name' => 'Angel Curator',
    'email' => 'curator@angel.com',
    'password' => Hash::make('curator123'),
    'role' => 'curator',
    'status' => 'active',
    'created_at' => now(),
    'updated_at' => now(),
]);
