<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('two_way_referral_forms', function (Blueprint $table) {
            $table->id();
            $table->text('reason_for_referral');
            $table->string('reffered_to'); // keeping your spelling
            $table->boolean('patient_category');
            $table->string('health_insurance');
            $table->boolean('charity');
            $table->boolean('pay');
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->nullOnDelete();
            $table->string('admitting_impression');
            $table->integer('systolic_bp');
            $table->integer('diastolic_bp');
            $table->integer('pulse_rate');
            $table->integer('respiratory_rate');
            $table->decimal('temperature', 5, 2);
            $table->decimal('weight', 8, 2);
            $table->string('reffered_by'); // keeping your spelling
            $table->string('designation');
            $table->string('contact_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('two_way_referral_forms');
    }
};
