<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Assign 'patient' role to any user without a role yet
        $usersWithoutRole = User::whereDoesntHave('roles')->get();

        if ($usersWithoutRole->count() > 0) {
            $patientRole = Role::where('name', 'patient')->first();

            if ($patientRole) {
                foreach ($usersWithoutRole as $user) {
                    $user->assignRole('patient');
                    // populate profile.role_id instead of user
                    if ($user->profile) {
                        $user->profile->update(['role_id' => $patientRole->id]);
                    }
                }

                $this->command->info("Assigned 'patient' role to {$usersWithoutRole->count()} users without roles.");
            }
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // This migration doesn't need reversing
    }
};
