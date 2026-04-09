<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
    App\Models\User;

        User::updateOrCreate(
        ['email' => 'djaglijosephbenoit@gmail.com'],
        [
            'name' => 'Joseph',
            'password' => 'Joseph1234', 
            'email_verified_at' => now(),
        ]
    );
    }
}
