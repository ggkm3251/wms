<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(CategoriesTableSeeder::class);

        User::firstOrCreate(
            ['email' => 'test@example.com'], // Check for existing user by email
            [
                'name' => 'Test User',
                'password' => bcrypt('password'), // Add a default password
                'email_verified_at' => now(), // Mark the email as verified
            ]
        );
    }
}
