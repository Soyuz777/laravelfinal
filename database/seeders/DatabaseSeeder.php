<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Optional: Create multiple random users
        // User::factory(10)->create();

        // Create a specific user (your admin)
        $admin = User::updateOrCreate(
            ['email' => 'putingbuhok1@gmail.com'],
            [
                'name' => 'Jansen Ofiaza (Admin)',
                'password' => bcrypt('putingbuhok1'), // Change this password securely later
                'role' => 'admin',                // If you're using a 'role' column
                'is_admin' => true,               // If you’re using a boolean instead
            ]
        );

        // Optionally call other seeders (like MakeAdminSeeder)
        // $this->call(MakeAdminSeeder::class);
    }
}
