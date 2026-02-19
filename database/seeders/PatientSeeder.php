<?php

namespace Database\Seeders;

use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // First, create the patient record
        $patient = Patient::firstOrCreate(
            [
                'address'                => '123 Main St, Cityville',
                'sex'                    => 'Male',
                'birth_place'            => 'Cityville',
                'civil_status'           => 'Single',
                'religion'               => 'None',
                'nationality'            => 'Filipino',
                'birth_date'             => '1990-01-01',
                'spouse_name'            => 'Vejee Laniog',
                'spouse_contact_number'  => '09887656744',
                'philhealth_number'      => 'PH123456789',
                'blood_type'             => 'O+',
                'allergies'              => 'None',
                'users_id'               => 1, // assuming admin user ID 1 created this patient
            ]
        );

        // Then, create a user account for the patient
        User::firstOrCreate(
            ['email' => 'johndamn@example.com'],
            [
                'firstname'   => 'John',
                'middlename'  => 'B',
                'lastname'    => 'Doe',
                'password'    => Hash::make('password123'),
                'role'        => 'patient',
                'patient_id'  => $patient->id, // link to patient record
                'contact_num' => '09123456789'
            ]
        );
    }
}
