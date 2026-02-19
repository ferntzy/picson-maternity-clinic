<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;

return new class extends Migration
{
    public function up(): void
    {
        // Only add foreign key if the column exists and foreign key not already added
        if (!Schema::hasColumn('patient', 'users_id')) {
            return;
        }

        Schema::table('patient', function (Blueprint $table) {
            // This checks the index name for duplicates
            $sm = Schema::getConnection()->getDoctrineSchemaManager();
            $indexes = $sm->listTableIndexes('patient');
            if (!array_key_exists('patient_users_id_foreign', $indexes)) {
                $table->foreign('users_id')
                      ->references('id')
                      ->on('users')
                      ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });
    }
};
