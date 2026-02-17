<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Hidden;

class PatientForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('address')->maxLength(255),
                Select::make('sex')->options([
                    'Male' => 'Male',
                    'Female' => 'Female',
                    'Other' => 'Other',
                ]),
                TextInput::make('birth_place')->maxLength(255),
                TextInput::make('civil_status')->maxLength(255),
                TextInput::make('religion')->maxLength(255),
                TextInput::make('nationality')->maxLength(255),
                TextInput::make('contact_number')->maxLength(20),
                DatePicker::make('birth_date'),
                TextInput::make('spouse_name')->maxLength(255),
                TextInput::make('spouse_contact_number')->maxLength(20),
                TextInput::make('philhealth_number')->maxLength(50),
                TextInput::make('blood_type')->maxLength(5),
                TextInput::make('allergies')->maxLength(255),
                TextInput::make('gravida')->numeric(),
                TextInput::make('term_birth')->numeric(),
                TextInput::make('pre_term_birth')->numeric(),
                TextInput::make('abortion')->numeric(),
                TextInput::make('living_children')->numeric(),

                // Automatically record the nurse/admin creating this patient
                Hidden::make('users_id')->default(fn () => auth()->id()),
            ]);
    }
}
