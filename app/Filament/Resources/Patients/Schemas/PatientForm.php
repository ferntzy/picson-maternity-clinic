<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
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

                /* ---------------- Patient Basic Info ---------------- */
                Grid::make(12)->components([
                    TextInput::make('address')
                        ->placeholder("Enter patient's address")
                        ->maxLength(255)
                        ->columnSpan(6),

                    Select::make('sex')
                        ->placeholder("Select patient's gender")
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other',
                        ])
                        ->columnSpan(6),
                ]),
                Grid::make(12)->components([
                    DatePicker::make('birth_date')
                        ->placeholder('Select birth date')
                        ->columnSpan(6),
                    TextInput::make('birth_place')
                        ->placeholder('Enter place of birth')
                        ->maxLength(255)
                        ->columnSpan(6),

                    
                ]),

                Grid::make(12)->components([
                    Select::make('civil_status')
                        ->placeholder('Single / Married / Widowed')
                        ->options([
                            'Single' => 'Single',
                            'Married' => 'Married',
                            'Widowed' => 'Widowed'
                        ])
                        ->columnSpan(6),

                    TextInput::make('religion')
                        ->placeholder("Enter patient's religion")
                        ->maxLength(255)
                        ->columnSpan(6),
                ]),

                Grid::make(12)->components([
                    TextInput::make('nationality')
                        ->placeholder("Enter patient's nationality")
                        ->maxLength(255)
                        ->columnSpan(6),

                    TextInput::make('contact_number')
                        ->placeholder("Enter patient's contact number")
                        ->maxLength(20)
                        ->tel()
                        ->columnSpan(6),

                    // TextInput::make('philhealth_number')
                    //     ->placeholder('PhilHealth Number')
                    //     ->maxLength(50)
                    //     ->columnSpan(4),
                ]),

                // /* ---------------- Emergency Contact ---------------- */
                // Grid::make(12)->components([
                //     TextInput::make('spouse_name')
                //         ->label('Emergency Contact Name')
                //         ->placeholder('Full name')
                //         ->maxLength(255)
                //         ->columnSpan(6),

                //     TextInput::make('spouse_contact_number')
                //         ->label('Emergency Contact Number')
                //         ->placeholder('09XXXXXXXXX')
                //         ->maxLength(20)
                //         ->tel()
                //         ->columnSpan(6),
                // ]),

                // /* ---------------- Medical Info ---------------- */
                // Grid::make(12)->components([
                //     TextInput::make('blood_type')
                //         ->placeholder('A+, O-, AB+')
                //         ->maxLength(5)
                //         ->columnSpan(3),

                //     TextInput::make('allergies')
                //         ->placeholder('e.g. Penicillin, Seafood')
                //         ->maxLength(255)
                //         ->columnSpan(9),
                // ]),

                // /* ---------------- OB History ---------------- */
                // Grid::make(12)->components([
                //     TextInput::make('gravida')
                //         ->placeholder('0')
                //         ->numeric()
                //         ->columnSpan(3),

                //     TextInput::make('term_birth')
                //         ->placeholder('0')
                //         ->numeric()
                //         ->columnSpan(3),

                //     TextInput::make('pre_term_birth')
                //         ->placeholder('0')
                //         ->numeric()
                //         ->columnSpan(3),

                //     TextInput::make('abortion')
                //         ->placeholder('0')
                //         ->numeric()
                //         ->columnSpan(3),
                // ]),

                // Grid::make(12)->components([
                //     TextInput::make('living_children')
                //         ->placeholder('0')
                //         ->numeric()
                //         ->columnSpan(3),
                // ]),

                /* ---------------- Hidden ---------------- */
                Hidden::make('users_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
