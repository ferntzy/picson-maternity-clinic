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
        Schema::create('profiles', function (Blueprint $table) {
            $table->id();
            $table->string('firstname', 255);
            $table->string('middlename', 255); 
            $table->string('lastname', 255);
            $table->string('address', 255)->nullable();
            $table->string('sex', 255)->nullable();
            $table->string('birth_place', 255)->nullable();
            $table->string('civil_status', 255)->nullable();
            $table->string('religion', 255)->nullable();
            $table->string('nationality', 255)->nullable();
            $table->string('birth_date', 255)->nullable();
            $table->string('emergency_contact_name', 255)->nullable();
            $table->string('emergency_contact_number', 255)->nullable();
            $table->string('philhealth_number', 255)->nullable();
            $table->enum('blood_type', ['A+', 'A-', 'B+', 'B-', 'AB+', 'AB-', 'O+', 'O-'])->nullable();
            $table->string('allergies', 255)->nullable();
            $table->string('contact_num', 255)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
