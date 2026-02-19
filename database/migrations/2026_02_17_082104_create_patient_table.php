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
        Schema::create('patient', function (Blueprint $table) {
            $table->id();
            $table->string('address', 255)->nullable();
            $table->string('sex', 255)->nullable();
            $table->string('birth_place', 255)->nullable();
            $table->string('civil_status', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('birth_date', 255)->nullable();
            $table->string('spouse_name', 255)->nullable();
            $table->string('spouse_contact_number', 255)->nullable();
            $table->string('philhealth_number', 255)->nullable();
            $table->string('blood_type', 255)->nullable();
            $table->string('allergies', 255)->nullable();
            $table->timestamps(); // creates created_at and updated_at
            $table->softDeletes(); // creates deleted_at
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('patient');
    }
};