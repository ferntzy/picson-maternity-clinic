<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // create some commonly used roles if they don't exist yet
        $roles = [
            'patient',
            'doctor',
            'nurse',
            'admin',
            'director',
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate(
                ['name' => $role],
                ['guard_name' => 'web']
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        $roles = ['patient', 'doctor', 'nurse', 'admin', 'director'];

        Role::whereIn('name', $roles)->delete();
    }
};
