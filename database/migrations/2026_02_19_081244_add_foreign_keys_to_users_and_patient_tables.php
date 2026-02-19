<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->foreign('users_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreign('patient_id')
                  ->references('id')
                  ->on('patient')
                  ->nullOnDelete();
        });
    }

    public function down(): void
    {
        Schema::table('patient', function (Blueprint $table) {
            $table->dropForeign(['users_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['patient_id']);
        });
    }
};
