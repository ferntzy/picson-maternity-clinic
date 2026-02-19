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
            $table->foreignId('delivery_id')->nullable()->constrained('deliveries')->nullOnDelete();
            $table->string('sex');
            $table->decimal('birth_weight');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->dateTime('date_time_of_birth');
            $table->decimal('head');
            $table->decimal('chest');
            $table->decimal('abdomen');
            $table->decimal('length');
            $table->string('newborn_screening_done');
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
