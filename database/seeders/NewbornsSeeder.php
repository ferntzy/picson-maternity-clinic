<?php

namespace Database\Seeders;

use App\Models\Newborns;
use Illuminate\Database\Seeder;

class NewbornsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Newborns::create([
            'sex' => 'Male',
            'birth_weight' => 3200,

            'firstname' => 'Baby',
            'middlename' => 'Test',
            'lastname' => 'Doe',
            'date_time_of_birth' => now(),

            'head' => 34,
            'chest' => 32,
            'abdomen' => 31,
            'length' => 50,

            'newborn_screening_done' => 'Yes',
            'inguinal_area' => 'Normal',
            'other_findings' => 'None',
            'impression' => 'Healthy newborn',
            'management' => 'Routine newborn care',
            'case_number' => 'CASE-0001',

            'deliveries_id' => 1, // created by DeliverySeeder
            'users_id' => 1,      // admin
            'patient_id' => 1,    // existing patient
        ]);
    }
}
