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
        if (Schema::hasTable('patient')) {
            return;
        }

        Schema::create('patient', function (Blueprint $table) {
            $table->id();
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
            $table->foreignId('users_id')
              ->constrained('users')
              ->cascadeOnDelete();
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
