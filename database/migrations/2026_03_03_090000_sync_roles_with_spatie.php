<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Add a role_id column to profiles table for quick identification
        if (!Schema::hasColumn('profiles', 'role_id')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->nullable()->after('role');
                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->nullOnDelete();
            });
        }

        // Migrate existing roles from profiles table to Spatie system
        // (we also update the new profiles.role_id instead of users.role_id)
        $this->migrateExistingRoles();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }

    /**
     * Migrate existing roles from profiles.role to Spatie roles system
     */
    private function migrateExistingRoles(): void
    {
        // Get all unique roles from profiles
        $existingRoles = DB::table('profiles')
            ->whereNotNull('role')
            ->distinct()
            ->pluck('role');

        // Get all users with their profile roles
        $usersWithRoles = DB::table('users')
            ->join('profiles', 'users.profile_id', '=', 'profiles.id')
            ->where('profiles.role', '!=', null)
            ->select('users.id', 'profiles.role', 'profiles.id as profile_id')
            ->get();

        // Assign roles via Spatie
        foreach ($usersWithRoles as $record) {
            $user = User::find($record->id);
            if ($user && $record->role) {
                try {
                    $user->assignRole(strtolower(trim($record->role)));

                    // Also set the role_id on profiles table for quick lookup
                    $role = Role::where('name', strtolower(trim($record->role)))->first();
                    if ($role) {
                        DB::table('profiles')
                            ->where('id', $record->profile_id)
                            ->update(['role_id' => $role->id]);
                    }
                } catch (\Exception $e) {
                    // Log error but continue
                    \Log::warning("Could not assign role '{$record->role}' to user {$record->id}: " . $e->getMessage());
                }
            }
        }
    }
};
