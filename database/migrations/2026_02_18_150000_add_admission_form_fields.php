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
        Schema::table('admissions', function (Blueprint $table) {
            // Form type column
            $table->enum('form_type', ['admission_consent', 'admission_discharge'])
                  ->nullable()
                  ->after('patient_id');

            // Consent form fields
            $table->text('consent_details')->nullable()->after('form_type');
            $table->boolean('consent_given')->default(false)->after('consent_details');
            $table->date('consent_date')->nullable()->after('consent_given');
            $table->string('consent_by')->nullable()->after('consent_date');
            $table->string('consent_relationship')->nullable()->after('consent_by');
            $table->text('special_instructions')->nullable()->after('consent_relationship');

            // Discharge form fields
            $table->dateTime('date_time_discharged')->nullable()->after('date_time_admitted');
            $table->enum('discharge_status', ['normal', 'cesarean', 'assisted', 'referred', 'ama'])
                  ->nullable()
                  ->after('date_time_discharged');
            $table->enum('baby_status', ['live_birth', 'stillbirth', 'multiple_birth'])
                  ->nullable()
                  ->after('discharge_status');
            $table->decimal('baby_weight', 5, 2)->nullable()->after('baby_status');
            $table->text('discharge_notes')->nullable()->after('baby_weight');
            $table->text('follow_up_instructions')->nullable()->after('discharge_notes');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('admissions', function (Blueprint $table) {
            $table->dropColumn([
                'form_type',
                'consent_details',
                'consent_given',
                'consent_date',
                'consent_by',
                'consent_relationship',
                'special_instructions',
                'date_time_discharged',
                'discharge_status',
                'baby_status',
                'baby_weight',
                'discharge_notes',
                'follow_up_instructions',
            ]);
        });
    }
};
