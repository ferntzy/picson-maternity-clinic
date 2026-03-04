<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // define some example permissions
        $permissions = [
            'view users',
            'edit users',
            'delete users',
            'view profiles',
            'edit profiles',
        ];

        foreach ($permissions as $perm) {
            Permission::firstOrCreate(['name' => $perm]);
        }

        // assign permissions to roles as a simple example
        $admin = Role::firstWhere('name', 'admin');
        if ($admin) {
            $admin->givePermissionTo(Permission::all());
        }

        $doctor = Role::firstWhere('name', 'doctor');
        if ($doctor) {
            $doctor->givePermissionTo(['view users', 'view profiles']);
        }
    }
}
