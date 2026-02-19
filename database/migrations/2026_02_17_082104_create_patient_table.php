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
<<<<<<< HEAD
            $table->string('address')->nullable();
            $table->string('sex')->nullable();
            $table->string('birth_place')->nullable();
            $table->string('civil_status')->nullable();
            $table->string('religion')->nullable();
            $table->string('nationality')->nullable();
            $table->string('birth_date')->nullable();
            $table->string('spouse_name')->nullable();
            $table->string('spouse_contact_number')->nullable();
            $table->string('philhealth_number')->nullable();
            $table->string('blood_type')->nullable();
            $table->string('allergies')->nullable();            
            $table->timestamps();
            $table->softDeletes();
            $table->unsignedBigInteger('users_id')->nullable();
            //   ->constrained('users')
            //   ->cascadeOnDelete();
=======
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
            $table->integer('gravida')->nullable();
            $table->integer('term_birth')->nullable();
            $table->integer('pre_term_birth')->nullable();
            $table->integer('abortion')->nullable();
            $table->integer('living_children')->nullable();
            $table->timestamps(); // creates created_at and updated_at
            $table->softDeletes(); // creates deleted_at
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
>>>>>>> main
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