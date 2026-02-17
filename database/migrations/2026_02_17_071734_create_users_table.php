<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (Schema::hasTable('users')) {
            return;
        }

        Schema::create('users', function (Blueprint $table) {
            $table->id();

            $table->string('firstname', 100);
            $table->string('middlename', 100)->nullable();
            $table->string('lastname', 100);
            $table->string('username', 100)->unique()->nullable();
            $table->string('email', 255)->unique()->nullable();
            $table->string('password', 255)->nullable();
            $table->string('contact_num', 45)->nullable();
            $table->string('avatar', 255)->nullable();
            $table->foreignId('patient_id')
                  ->nullable()
                  ->constrained('patient')
                  ->nullOnDelete();
            $table->string('role', 45)->nullable();
            $table->string('google_id', 255)->nullable()->unique();
            $table->string('google_token', 255)->nullable();
            $table->string('google_refresh_token', 255)->nullable();
            $table->timestamp('google_token_expires_at')->nullable();

            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
