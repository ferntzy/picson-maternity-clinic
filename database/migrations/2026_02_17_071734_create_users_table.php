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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('email', 255)->nullable();
            $table->text('password')->nullable();
            $table->string('firstname', 255)->nullable();
            $table->string('middlename', 255)->nullable();
            $table->string('lastname', 255)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->unsignedBigInteger('patient_id')->nullable();
            $table->string('role', 45)->nullable();
            $table->timestamps(); // creates created_at and updated_at
            $table->softDeletes(); // creates deleted_at
            $table->string('contact_num', 255)->nullable();
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