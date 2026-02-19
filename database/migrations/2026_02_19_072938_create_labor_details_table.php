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
        Schema::create('labor_details', function (Blueprint $table) {
            $table->id();

            $table->dateTime('date_labor_started')->nullable();
            $table->date('edc')->nullable();
            $table->string('aog')->nullable();
            $table->string('presentation')->nullable();
            $table->integer('number_of_fetus')->nullable();
            $table->enum('membranes_status', ['intact', 'ruptured'])->nullable();
            $table->dateTime('time_membranes_ruptured')->nullable();
            $table->decimal('cervical_dilation_initial', 10, 2)->nullable();
            $table->string('effacement')->nullable();
            $table->enum('vaginal_bleeding_late_pregnancy', ['yes', 'no'])->nullable();
            $table->decimal('fundic_height',10,2)->nullable();
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
        Schema::dropIfExists('labor_details');
    }
};
