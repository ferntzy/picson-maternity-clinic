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
        Schema::create('newborns', function (Blueprint $table) {
            $table->id();
            $table->string('sex')->nullable();
            $table->decimal('birth_weight', 10, 0)->nullable();
            $table->string('firstname')->nullable();
            $table->string('middlename')->nullable();
            $table->string('lastname')->nullable();
            $table->dateTime('date_time_of_birth')->nullable();
            $table->decimal('head', 10, 0)->nullable();
            $table->decimal('chest', 10, 0)->nullable();
            $table->decimal('abdomen', 10, 0)->nullable();
            $table->decimal('length', 10, 0)->nullable();
            $table->string('newborn_screening_done')->nullable();
            $table->string('inguinal_area')->nullable();
            $table->string('other_findings')->nullable();
            $table->string('impression')->nullable();
            $table->string('management')->nullable();
            $table->string('case_number')->nullable();
            $table->foreignId('deliveries_id')->constrained('deliveries')->cascadeOnDelete();
            $table->foreignId('users_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('patient_id')->constrained('patient')->cascadeOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborns');
    }
};