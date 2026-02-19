<?php

namespace App\Filament\Resources\Admissions\Schemas;

use Filament\Schemas\Schema;
use Filament\Schemas\Components\Grid;
use Filament\Forms\Components\Select;
use App\Models\Patient;

class AdmissionForm
{
    /**
     * Get the appropriate form schema based on form type
     */
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Patient Selection (Always visible)
                Grid::make(12)->components([
                Select::make('patient_id')
                ->label('Patient')
                ->placeholder('Search by name')
                ->searchable()
                ->getSearchResultsUsing(function (string $search) {
                    return Patient::where(function($query) use ($search) {
                        $query->whereHas('user', function ($q) use ($search) {
                            $q->where('firstname', 'LIKE', "%{$search}%")
                            ->orWhere('lastname', 'LIKE', "%{$search}%"); // search User contact
                        });
                    })
                    ->limit(50)
                    ->get()
                    ->mapWithKeys(function ($patient) {
                        $label = $patient->user?->getFilamentName();
                        return [$patient->id => $label];
                    })
                    ->toArray();
                })
                ->getOptionLabelUsing(fn($value) => 
                    Patient::find($value)?->userAccount?->getFilamentName() 
                    ?? 'Patient #' . $value
                )
                ->required()
                ->columnSpan(12)

            ]),
        ]);
    }

    /**
     * Get form schema for Admission Consent
     */
    public static function getConsentForm(Schema $schema): Schema
    {
        return AdmissionConsentForm::configure($schema);
    }

    /**
     * Get form schema for Admission and Discharge
     */
    public static function getAdmissionDischargeForm(Schema $schema): Schema
    {
        return AdmissionDischargeForm::configure($schema);
    }
}
