<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        $now = '2026-03-03 00:03:53';

        $roles = [
            ['id' => 1, 'name' => 'admin',    'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 2, 'name' => 'director', 'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 3, 'name' => 'doctor',   'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 4, 'name' => 'nurse',    'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
            ['id' => 5, 'name' => 'patient',  'guard_name' => 'web', 'created_at' => $now, 'updated_at' => $now],
        ];

        DB::table('roles')->insertOrIgnore($roles);
    }
}
