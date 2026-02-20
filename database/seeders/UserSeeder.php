<?php

namespace Database\Seeders;

use App\Models\Profiles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profiles::create([
            'email' => 'admin@example.com',
            'password' => bcrypt('123456'),
            'role' => 'admin',
            'profile_id' => 1, // Assuming this user is linked to the first profile created by PatientSeeder
        ]);
    }
}
