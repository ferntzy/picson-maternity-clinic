<?php

namespace App\Filament\Resources\Admissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Textarea;
use App\Models\Patient;

class AdmissionConsentForm
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
            ]);
    }
}
