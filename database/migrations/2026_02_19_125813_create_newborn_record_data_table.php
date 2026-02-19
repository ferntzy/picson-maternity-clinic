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
        Schema::create('newborn_record_data', function (Blueprint $table) {
            $table->id();
            $table->foreignId('newborn_id')->nullable()->constrained('newborns')->nullOnDelete();
            $table->string('assesment_type');
            $table->string('item');
            $table->string('value');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('newborn_record_data');
    }
};
