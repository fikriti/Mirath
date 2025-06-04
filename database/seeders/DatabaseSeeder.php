<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 1 random user
        User::factory()->count(1)->create();

        // Create an admin user
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin00@gmail.com',
            'password' => Hash ::make('123456789'), // Securely hashed
            'role' => 1
        ]);
    }
}
