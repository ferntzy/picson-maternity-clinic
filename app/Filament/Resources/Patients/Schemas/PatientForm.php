<?php

namespace App\Filament\Resources\Patients\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Group;
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
                Group::make()
                    ->relationship('user')
                    ->schema([
                        Grid::make(12)->components([
                            TextInput::make('firstname')
                                ->label('First Name')
                                ->placeholder('Enter first name')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('middlename')
                                ->label('Middle Name')
                                ->placeholder('Enter middle name')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('lastname')
                                ->label('Last Name')
                                ->placeholder('Enter last name')
                                ->required()
                                ->columnSpan(3),
                            TextInput::make('contact_num')
                                ->label('Contact Number')
                                ->placeholder("Enter patient's contact number")
                                ->tel()
                                ->required()
                                ->columnSpan(3),
                        ]),
                    ]),
                Grid::make(12)->components([
                    TextInput::make('address')
                        ->placeholder("Enter patient's address")
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),

                    Select::make('sex')
                        ->placeholder("Select patient's gender")
                        ->options([
                            'Male' => 'Male',
                            'Female' => 'Female',
                            'Other' => 'Other',
                        ])
                        ->required()
                        ->columnSpan(4),

                    DatePicker::make('birth_date')
                        ->placeholder('Select birth date')
                        ->required()
                        ->columnSpan(4),
                ]),
                Grid::make(12)->components([
                    TextInput::make('birth_place')
                        ->placeholder('Enter place of birth')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),

                    Select::make('civil_status')
                        ->placeholder('Single / Married / Widowed')
                        ->options([
                            'Single' => 'Single',
                            'Married' => 'Married',
                            'Widowed' => 'Widowed',
                        ])
                        ->required()
                        ->columnSpan(4),

                    TextInput::make('religion')
                        ->placeholder("Enter patient's religion")
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),
                ]),
                Grid::make(12)->components([
                    TextInput::make('nationality')
                        ->placeholder("Enter patient's nationality")
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),

                    TextInput::make('philhealth_number')
                        ->placeholder('Enter PhilHealth number')
                        ->required()
                        ->maxLength(50)
                        ->columnSpan(4),

                    TextInput::make('allergies')
                        ->placeholder('e.g. Penicillin, Seafood')
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),
                ]),
                Grid::make(12)->components([
                    TextInput::make('blood_type')
                        ->label('Blood Type')
                        ->placeholder("Enter patient's blood type")
                        ->required()
                        ->maxLength(255)
                        ->columnSpan(4),
                    TextInput::make('spouse_name')
                        ->label('Spouse / Emergency Contact')
                        ->helperText('If not applicable, enter the emergency contact person.')
                        ->required()
                        ->placeholder('Enter full name')
                        ->maxLength(255)
                        ->columnSpan(4),

                    TextInput::make('spouse_contact_number')
                        ->label('Spouse / Emergency Contact Number')
                        ->placeholder('Enter contact number')
                        ->maxLength(20)
                        ->tel()
                        ->required()
                        ->columnSpan(4),
                ]),

                Hidden::make('users_id')
                    ->default(fn () => auth()->id()),
            ]);
    }
}
