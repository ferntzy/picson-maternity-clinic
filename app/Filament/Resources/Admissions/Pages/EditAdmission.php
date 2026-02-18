<?php

namespace App\Filament\Resources\Admissions\Pages;

use App\Filament\Resources\Admissions\AdmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Actions\ViewAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Actions\ForceDeleteAction;
use Filament\Actions\RestoreAction;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Checkbox;

class EditAdmission extends EditRecord
{
    protected static string $resource = AdmissionResource::class;

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Form Type Selector
                Section::make('Form Selection')
                    ->schema([
                        Grid::make(12)->components([
                            Select::make('form_type')
                                ->label('Form Type')
                                ->placeholder('Select the type of form...')
                                ->options([
                                    'admission_consent' => 'Admission Consent Form',
                                    'admission_discharge' => 'Admission and Discharge Form',
                                ])
                                ->required()
                                ->live()
                                ->columnSpan(12),
                        ]),
                    ]),

                // Admission Consent Form Fields
                Section::make('Admission Consent Details')
                    ->visible(fn ($get) => $get('form_type') === 'admission_consent')
                    ->schema([
                        Grid::make(12)->components([
                            Textarea::make('consent_details')
                                ->label('Admission Consent Details')
                                ->placeholder('Enter consent details and information...')
                                ->rows(5)
                                ->columnSpan(12),
                        ]),
                        Grid::make(12)->components([
                            Checkbox::make('consent_given')
                                ->label('Patient has given written consent')
                                ->columnSpan(6),
                            
                            DatePicker::make('consent_date')
                                ->label('Date of Consent')
                                ->columnSpan(6),
                        ]),
                        Grid::make(12)->components([
                            TextInput::make('consent_by')
                                ->label('Consent Given By')
                                ->placeholder('Name of person giving consent')
                                ->maxLength(255)
                                ->columnSpan(6),

                            TextInput::make('consent_relationship')
                                ->label('Relationship to Patient')
                                ->placeholder('e.g., Self, Spouse, Parent, Guardian')
                                ->maxLength(255)
                                ->columnSpan(6),
                        ]),
                        Grid::make(12)->components([
                            Textarea::make('special_instructions')
                                ->label('Special Instructions/Notes')
                                ->placeholder('Any special instructions or notes...')
                                ->rows(4)
                                ->columnSpan(12),
                        ]),
                    ]),

                // Admission and Discharge Form Fields
                Section::make('Admission Details')
                    ->visible(fn ($get) => $get('form_type') === 'admission_discharge')
                    ->schema([
                        Grid::make(12)->components([
                            DateTimePicker::make('date_time_admitted')
                                ->label('Date & Time Admitted')
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
                    ]),

                Section::make('Discharge Details')
                    ->visible(fn ($get) => $get('form_type') === 'admission_discharge')
                    ->schema([
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
                    ]),
            ]);
    }

    protected function getHeaderActions(): array
    {
        return [
            ViewAction::make(),
            DeleteAction::make(),
            RestoreAction::make(),
            ForceDeleteAction::make(),
        ];
    }
}



