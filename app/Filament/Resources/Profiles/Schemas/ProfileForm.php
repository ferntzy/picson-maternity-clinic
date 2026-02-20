<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class ProfileForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)->components([
                    TextInput::make('firstname')
                        ->label('First Name')
                        ->placeholder("Enter patient's firstname")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('middlename')
                        ->label('Middle Name')
                        ->placeholder("Enter patient's middlename")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('lastname')
                        ->label('Last Name')
                        ->placeholder("Enter patient's lastname")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4)
                ]),
                Grid::make(12)->components([
                    TextInput::make('address')
                        ->label('Address')
                        ->placeholder("Enter patient's address")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    Select::make('sex')
                        ->label("Select patient's gender")
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                            'other' => 'Other',
                        ])
                        ->default('Female')
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem;'])
                        ->columnSpan(4),

                    TextInput::make('birth_place')
                        ->label('Birth Place')
                        ->placeholder("Enter patient's birth place")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),
                ]),

                Grid::make(12)->components([
                    Select::make('civil_status')
                        ->label("Select patient's civil status")
                        ->options([
                            'single' => 'Single',
                            'married' => 'Married',
                            'widowed' => 'Widowed',
                        ])
                        ->default('Female')
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem;'])
                        ->columnSpan(4),

                    TextInput::make('religion')
                        ->label('Religion')
                        ->placeholder("Enter patient's birth place")
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('nationality')
                        ->label('Nationality')
                        ->placeholder("Enter patient's nationality")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),
                ]),

                Grid::make(12)->components([
                    DatePicker::make('birth_date')
                        ->label('Birth Date')
                        ->placeholder("Enter patient's birthdate")
                        ->native(false)
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('emergency_contact-name')
                        ->label('Emergency Contact Name')
                        ->placeholder("Enter patient's emergency contact name")
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('emergency_contact_number')
                        ->label('Emergency Contact Number')
                        ->placeholder("Enter patient's emergency contact number")
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),
                ]),

                Grid::make(12)->components([
                    TextInput::make('blood_type')
                        ->label('Blood Type')
                        ->placeholder("Enter patient's blood type")
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('allergies')
                        ->label('Allergies')
                        ->placeholder("Enter patient's allergies")
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),

                    TextInput::make('contact_num')
                        ->label('Contact Number')
                        ->placeholder("Enter patient's contact number")
                        ->numeric()
                        ->required()
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'])
                        ->columnSpan(4),
                ]),                
            ]);
    }
}
