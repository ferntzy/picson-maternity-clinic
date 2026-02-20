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
        Schema::create('return_or_discharge_slips', function (Blueprint $table) {
            $table->id(); 
            $table->foreignId('referral_form_id')->nullable()->constrained('two_way_referral_forms')->nullOnDelete();
            $table->date('date_admitted');
            $table->date('date_discharge');
            $table->text('final_diagnosis');
            $table->string('action_taken');
            $table->string('recommendation');
            $table->string('attend_by');
            $table->string('designation');
            $table->string('contact_number');
            $table->timestamps();
            $table->softDeletes();
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('return_or_discharge_slips');
    }
};
