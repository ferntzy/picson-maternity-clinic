<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@example.com'], // check if user already exists
            [
                'firstname'  => 'Admin',
                'middlename' => 'A',
                'lastname'   => 'User',
                'password'   => 'password123',
                'role'       => 'admin',
            ]
        );

    }
}
