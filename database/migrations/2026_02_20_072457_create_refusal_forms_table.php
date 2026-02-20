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
        Schema::create('refusal_forms', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('profile_id')->nullable()->constrained('profiles')->nullOnDelete();
            $table->text('reasons');
            $table->string('witness_by');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('refusal_forms');
    }
};
