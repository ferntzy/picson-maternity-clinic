<?php

namespace Database\Seeders;

use App\Models\Profiles;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Profiles::create([
            'firstname' => 'Rovic',
            'middlename' => 'Love',
            'lastname' => 'Harley',
            'address' => 'Inopacan, Leyte',
            'sex' => 'Female',
            'birth_place' => 'Maasin City, Southern Leyte',
            'civil_status' => 'single',
            'religion' => 'Muslim',
            'nationality' => 'Australian',
            'birth_date' => '1998-02-20',
            'emergency_contact_name' => 'Rafael T. Virgin',
            'emergency_contact_number' => '09287645377',
            'philhealth_number' => '01983265123',
            'blood_type' => 'A+',
            'allergies' => 'None',
            'contact_num' => '092837467577',
        ]);
    }
}
