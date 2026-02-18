<?php

namespace App\Filament\Resources\Admissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;
use App\Models\Patient;

class AdmissionDischargeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Grid::make(12)->components([
                    Select::make('patient_id')
                        ->label('Patient')
                        ->placeholder('Search and select patient by name...')
                        ->searchable()
                        ->preload()
                        ->getSearchResultsUsing(fn(string $search) => 
                            Patient::whereHas('userAccount', fn($query) => 
                                $query->where('firstname', 'LIKE', "%{$search}%")
                                      ->orWhere('lastname', 'LIKE', "%{$search}%")
                                      ->orWhere('email', 'LIKE', "%{$search}%")
                            )
                            ->orWhere('contact_number', 'LIKE', "%{$search}%")
                            ->limit(50)
                            ->get()
                            ->mapWithKeys(fn($patient) => [
                                $patient->id => $patient->userAccount?->getFilamentName() ?? 'Patient #' . $patient->id
                            ])
                            ->toArray()
                        )
                        ->getOptionLabelUsing(fn($value) => 
                            Patient::find($value)?->userAccount?->getFilamentName() ?? 'Patient #' . $value
                        )
                        ->required()
                        ->columnSpan(12),
                ]),

                // Admission Details
                Grid::make(12)->components([
                    DateTimePicker::make('date_time_admitted')
                        ->label('Date & Time Admitted')
                        ->required()
                        ->columnSpan(6),

                    Select::make('stage_of_labor')
                        ->label('Stage of Labor')
                        ->placeholder('Select stage of labor')
                        ->options([
                            'first_stage' => 'First Stage',
                            'second_stage' => 'Second Stage',
                            'third_stage' => 'Third Stage',
                        ])
                        ->columnSpan(6),
                ]),

                Grid::make(12)->components([
                    TextInput::make('hemoglobin')
                        ->label('Hemoglobin Level (g/dL)')
                        ->numeric()
                        ->step(0.1)
                        ->columnSpan(4),

                    Checkbox::make('rpr')
                        ->label('RPR Test')
                        ->columnSpan(4),

                    Checkbox::make('hiv')
                        ->label('HIV Test')
                        ->columnSpan(4),
                ]),

                // Discharge Details
                Grid::make(12)->components([
                    DateTimePicker::make('date_time_discharged')
                        ->label('Date & Time Discharged')
                        ->columnSpan(6),

                    Select::make('discharge_status')
                        ->label('Discharge Status')
                        ->placeholder('Select discharge status')
                        ->options([
                            'normal' => 'Normal Delivery',
                            'cesarean' => 'Cesarean Section',
                            'assisted' => 'Assisted Delivery',
                            'referred' => 'Referred',
                            'ama' => 'Against Medical Advice',
                        ])
                        ->columnSpan(6),
                ]),

                Grid::make(12)->components([
                    Select::make('baby_status')
                        ->label('Baby Status')
                        ->placeholder('Select baby status')
                        ->options([
                            'live_birth' => 'Live Birth',
                            'stillbirth' => 'Stillbirth',
                            'multiple_birth' => 'Multiple Birth',
                        ])
                        ->columnSpan(6),

                    TextInput::make('baby_weight')
                        ->label('Baby Weight (kg)')
                        ->numeric()
                        ->step(0.1)
                        ->columnSpan(6),
                ]),

                Grid::make(12)->components([
                    Textarea::make('discharge_notes')
                        ->label('Discharge Notes')
                        ->placeholder('Enter discharge notes and instructions...')
                        ->rows(4)
                        ->columnSpan(12),
                ]),

                Grid::make(12)->components([
                    Textarea::make('follow_up_instructions')
                        ->label('Follow-up Instructions')
                        ->placeholder('Enter follow-up instructions for patient...')
                        ->rows(4)
                        ->columnSpan(12),
                ]),
            ]);
    }
}
