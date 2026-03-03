<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Sync role_id column with the primary role from model_has_roles
        // For users with multiple roles, use the first assigned role
        $records = DB::table('model_has_roles')
            ->where('model_type', 'App\\Models\\User')
            ->select('model_id', 'role_id')
            ->orderBy('model_id')
            ->orderBy('role_id')
            ->get();

        foreach ($records as $record) {
            DB::table('users')
                ->where('id', $record->model_id)
                ->update(['role_id' => $record->role_id]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Can't safely reverse this
    }
};
