<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            return;
        }

        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->nullable();
            $table->text('password')->nullable();
            $table->string('firstname', 255)->nullable();
            $table->string('middlename', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('pfp_url', 255)->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('role', 45)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->timestamp('deleted_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
