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
        Schema::create('birth_and_emergency_plans', function (Blueprint $table) {
            $table->id();
            $table->string('deliver_at');
            $table->boolean('phi_accredited')->default(true);
            $table->boolean('phi_member')->default(true);
            $table->int('estimated_cost');
            $table->string('payment_mode');
            $table->string('available_transport_to_facility');
            $table->string('communicated_with');
            $table->string('accompanied_with');
            $table->string('children_taken_care_by');
            $table->string('emergency_number');
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->nullOnDelete();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('birth_and_emergency_plans');
    }
};
