<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create admin user if it doesn't exist
        User::firstOrCreate(
            ['email' => 'admin@urbangreen.com'],
            [
                'first_name' => 'Admin',
                'last_name' => 'User',
                'email' => 'admin@urbangreen.com',
                'password' => Hash::make('admin123'),
                'role' => User::ROLE_ADMIN,
                'email_verified_at' => now(),
            ]
        );
    }
}
