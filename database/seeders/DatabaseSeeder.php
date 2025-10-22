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
        // Seed demo users for each role
        User::factory()->create([
            'first_name' => 'Alice',
            'last_name' => 'Association',
            'email' => 'association@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => \App\Models\User::ROLE_ASSOCIATION,
        ]);

        User::factory()->create([
            'first_name' => 'Paul',
            'last_name' => 'Partner',
            'email' => 'partner@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => \App\Models\User::ROLE_PARTNER,
        ]);

        User::factory()->create([
            'first_name' => 'Victor',
            'last_name' => 'Volunteer',
            'email' => 'volunteer@example.com',
            'password' => \Illuminate\Support\Facades\Hash::make('password'),
            'role' => \App\Models\User::ROLE_VOLUNTEER,
        ]);
    }
}
