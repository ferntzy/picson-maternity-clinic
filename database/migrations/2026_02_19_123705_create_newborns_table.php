<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('newborns', function (Blueprint $table) {
            $table->id();
            $table->foreignId('delivery_id')->nullable()->constrained('deliveries')->nullOnDelete();
            $table->string('sex');
            $table->decimal('birth_weight', 8, 2);
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');
            $table->dateTime('date_time_of_birth');
            $table->decimal('head', 8, 2);
            $table->decimal('chest', 8, 2);
            $table->decimal('abdomen', 8, 2);
            $table->decimal('length', 8, 2);
            $table->string('newborn_screening_done');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('newborns');
    }
};
