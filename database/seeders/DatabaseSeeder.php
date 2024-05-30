<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // uses factory for creating user with the type 'owner'
        User::factory()->create([
            'name' => 'Owner',
            'email' => 'owner@gmail.com',
            'usertype' => 'owner',
            'password' => Hash::make('asdfasdf'), // uses Hash for password, can change to bycrypt
        ]);

        // uses factory for creating user with the type 'admin'
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'usertype' => 'admin',
            'password' => Hash::make('asdfasdf'), 
        ]);
    }
}
