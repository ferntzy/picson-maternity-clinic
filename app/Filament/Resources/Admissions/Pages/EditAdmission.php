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
                                    'admission_labor' => 'Admission and Labor Record Form',
                                ])
                                ->required()
                                ->live()
                                ->columnSpan(12),
                        ]),
                    ]),
                //Admission Consent Form Fields
                Section::make('Admission Details')
                    ->visible(fn ($get) => $get('form_type') === 'admission_consent')
                    ->schema([

                    Grid::make(12)->components([
                            DateTimePicker::make('date_of_consent')
                                ->label('Date & Time of Consent')
                                ->columnSpan(6),

                           
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

                            DateTimePicker::make('date_time_discharged')
                                ->label('Date & Time Discharged')
                                ->columnSpan(6),
                        ]),

                        Grid::make(12)->components([
                            TextInput::make('number_of_days_stay')
                                ->label('Number of Days Stayed')
                                ->numeric()
                                ->columnSpan(4),

                            Select::make('type_of_admission')
                                ->label('Type of Admission')
                                ->options([
                                    'new' => 'New',
                                    'old' => 'Old',
                                ])
                                ->columnSpan(4),

                            Select::make('service_classification')
                                ->label('Service Classification')
                                ->options([
                                    'philhealth' => 'PhilHealth',
                                    'non_philhealth' => 'Non-PhilHealth',
                                ])
                                ->columnSpan(4),
                        ]),

                        Grid::make(12)->components([
                            TextInput::make('admitting_diagnosis')
                                ->label('Admitting Diagnosis')
                                ->placeholder('Enter admitting diagnosis details...')
                                ->columnSpan(4),

                            TextInput::make('admitting_icd_code')
                                ->label('Admitting ICD Code')
                                ->placeholder('Enter admitting ICD code details...')
                                ->columnSpan(4),

                            TextInput::make('final_diagnosis')
                                ->label('Final Diagnosis')
                                ->placeholder('Enter final diagnosis details...')
                                ->columnSpan(4),

                            TextInput::make('final_icd_code')
                                ->label('Final ICD Code')
                                ->placeholder('Enter final ICD code details...')
                                ->columnSpan(4),
                        ]),

                        Grid::make(12)->components([
                            Select::make('result_outcome')
                                ->label('Result/Outcome')
                                ->options([
                                    'delivered' => 'Delivered',
                                    'improved' => 'Improved',
                                    'unimproved' => 'Unimproved',
                                    'died' => 'Died',
                                    'referred' => 'Referred',
                                ])
                                ->columnSpan(6),

                            TextInput::make('referred_by')
                                ->label('Referred By')
                                ->placeholder('Enter referral source details...')
                                ->columnSpan(6),
                        ]),
                    ]),
                    Section::make('Admission Details')
                    ->visible(fn ($get) => $get('form_type') === 'admission_labor')
                    ->schema([

                    Grid::make(12)->components([
                            DateTimePicker::make('date_of_consent')
                                ->label('Date & Time of Consent')
                                ->columnSpan(6),

                           
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
