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
        Schema::create('labor_monitorings', function (Blueprint $table) {
            $table->id();

            $table->integer('hour_since-arrival')->nullable();
            $table->time('time_recorded')->nullable();
            $table->integer('hours_since_membrane_rupture')->nullable();
            $table->enum('vaginal_bleeding',['o','+','++'])->nullable();
            $table->integer('contractions_per_10_min')->nullable();
            $table->integer('fetal_heart_timed')->nullable();
            $table->decimal('maternal_temp',10,2)->nullable();
            $table->integer('pulse_rate')->nullable();
            $table->integer('systolic_bp')->nullable();
            $table->integer('diastolic_bp')->nullable();
            $table->decimal('cervical_dilation',10,2)->nullable();
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('labor_monitorings');
    }
};
