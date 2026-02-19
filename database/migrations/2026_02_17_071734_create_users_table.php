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
            $table->string('avatar', 255)->nullable();
            $table->unsignedBigInteger('profile_id')->nullable();
            $table->string('role', 45)->nullable();
            $table->timestamps(); // creates created_at and updated_at
            $table->softDeletes(); // creates deleted_at
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