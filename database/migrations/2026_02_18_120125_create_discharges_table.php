<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('discharges', function (Blueprint $table) {
            $table->id();
            
            $table->dateTime('date_time_admitted')->nullable();
            $table->dateTime('date_time_discharged')->nullable();
            $table->integer('number_of_days_stay')->nullable();
            $table->enum('type_of_admission',['new','old'])->nullable();
            $table->enum('service_classification',['philhealth','nonphilhealth'])->nullable();
            $table->string('admitting_diagnosis')->nullable();
            $table->string('admitting_icd_code')->nullable();
            $table->string('final_diagnosis')->nullable();
            $table->string('final_icd_code')->nullable();
            $table->enum('result_outcome',['delivered','improved','unimproved','died','referred'])->nullable();
            $table->string('referred_by')->nullable();
            

            // Foreign Keys
            $table->foreignId('admissions_id')
                ->constrained('admissions')
                ->cascadeOnDelete();

            $table->foreignId('users_id')
                ->constrained('users')
                ->cascadeOnDelete();

            $table->foreignId('created_by')
                ->nullable()
                ->constrained('users')
                ->nullOnDelete();

            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('discharges');
    }
};
