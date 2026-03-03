<?php

namespace Database\Seeders;

use App\Models\Roles;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roles::create([
            'name' => 'admin'
        ]);
        Roles::create([
            'name' => 'doctor'
        ]);
        Roles::create([
            'name' => 'nurse'
        ]);
        Roles::create([
            'name' => 'patient'
        ]);
        Roles::create([
            'name' => 'newborn'
        ]);
    }
}
