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
        Schema::create('admissions', function (Blueprint $table) {
            $table->id();

            $table->string('rpr')->nullable();
            $table->string('hiv')->nullable();
            $table->decimal('hemoglobin', 10, 2)->nullable();
            $table->dateTime('date_time_admitted')->nullable();
            $table->enum('stage_of_labor', ['active', 'not_active'])
                  ->default('active');
            $table->unsignedBigInteger('patient_id')->nullable();

            $table->integer('gravida')->nullable();    
            $table->integer('para')->nullable();
            $table->integer('abortus')->nullable();
            $table->integer('fullterm')->nullable();
            $table->integer('preterm')->nullable();
            $table->integer('living')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('admissions');
    }
};
