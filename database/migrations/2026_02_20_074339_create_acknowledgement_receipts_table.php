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
        Schema::create('acknowledgement_receipts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('referral_form_id')->nullable()->constrained('two_way_referral_forms')->nullOnDelete();
            $table->date('date');
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->nullOnDelete();
            $table->string('statis_upon_receipt_at_er');
            $table->enum('actions_taken', ['admitted', 'reffered to other facility', 'manage as opd']);
            $table->string('receiving_hostpital');
            $table->string('contact_person');
            $table->string('contact_number');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('acknowledgement_receipts');
    }
};
