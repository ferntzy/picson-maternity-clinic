<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // ensure profiles table has a role_id column
        if (! Schema::hasColumn('profiles', 'role_id')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->nullable()->after('role');
                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->nullOnDelete();
            });
        }

        // copy any existing string-based roles on profiles to the new role_id
        $roles = Role::all()->keyBy(function ($r) {
            return strtolower(trim($r->name));
        });

        DB::table('profiles')
            ->whereNotNull('role')
            ->chunkById(100, function ($rows) use ($roles) {
                foreach ($rows as $row) {
                    $name = strtolower(trim($row->role));
                    if ($roles->has($name)) {
                        DB::table('profiles')
                            ->where('id', $row->id)
                            ->update(['role_id' => $roles->get($name)->id]);
                    }
                }
            });

        // copy any denormalized role_id from users (if still present) to profiles
        if (Schema::hasColumn('users', 'role_id')) {
            DB::table('users')
                ->whereNotNull('role_id')
                ->chunkById(100, function ($rows) {
                    foreach ($rows as $row) {
                        if ($row->profile_id) {
                            DB::table('profiles')
                                ->where('id', $row->profile_id)
                                ->update(['role_id' => $row->role_id]);
                        }
                    }
                });
        }

        // finally, drop the column from users now that we keep it on profiles
        if (Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // add role_id back to users if missing
        if (! Schema::hasColumn('users', 'role_id')) {
            Schema::table('users', function (Blueprint $table) {
                $table->unsignedBigInteger('role_id')->nullable()->after('profile_id');
                $table->foreign('role_id')
                    ->references('id')
                    ->on('roles')
                    ->nullOnDelete();
            });

            // copy values back from profiles
            DB::table('profiles')
                ->whereNotNull('role_id')
                ->chunkById(100, function ($rows) {
                    foreach ($rows as $row) {
                        // find any users pointing at this profile
                        DB::table('users')
                            ->where('profile_id', $row->id)
                            ->update(['role_id' => $row->role_id]);
                    }
                });
        }

        // remove role_id from profiles
        if (Schema::hasColumn('profiles', 'role_id')) {
            Schema::table('profiles', function (Blueprint $table) {
                $table->dropForeign(['role_id']);
                $table->dropColumn('role_id');
            });
        }
    }
};
