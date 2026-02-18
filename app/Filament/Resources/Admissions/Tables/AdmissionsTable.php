<?php

namespace App\Filament\Resources\Admissions\Tables;

use App\Models\Admission;
use App\Filament\Resources\Admissions\Schemas\AdmissionForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class AdmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('patient.userAccount.firstname')
                    ->label('Patient Name')
                    ->getStateUsing(fn ($record) =>
                        $record->patient?->userAccount
                            ? "{$record->patient->userAccount->firstname} {$record->patient->userAccount->lastname}"
                            : 'N/A'
                    )
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->whereHas('patient.userAccount', function (Builder $q) use ($search) {
                                $q->where('firstname', 'like', "%{$search}%")
                                    ->orWhere('lastname', 'like', "%{$search}%");
                            });
                        }
                    ),
                BadgeColumn::make('form_type')
                    ->label('Form Type')
                    ->colors([
                        'info' => 'admission_consent',
                        'success' => 'admission_discharge',
                    ])
                    ->formatStateUsing(fn ($state) => match($state) {
                        'admission_consent' => 'Admission Consent',
                        'admission_discharge' => 'Admission & Discharge',
                        default => $state,
                    }),
                TextColumn::make('date_time_admitted')
                    ->label('Date Admitted')
                    ->dateTime('M d, Y H:i')
                    ->sortable(),
                TextColumn::make('stage_of_labor')
                    ->label('Stage of Labor')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'first_stage' => 'First Stage',
                        'second_stage' => 'Second Stage',
                        'third_stage' => 'Third Stage',
                        default => $state,
                    })
                    ->visible(fn ($record) => $record && $record->stage_of_labor !== null),
                TextColumn::make('hemoglobin')
                    ->label('Hemoglobin (g/dL)')
                    ->visible(fn ($record) => $record && $record->hemoglobin !== null),
                BadgeColumn::make('rpr')
                    ->label('RPR')
                    ->formatStateUsing(fn ($state) => $state ? 'Positive' : 'Negative')
                    ->colors([
                        'danger' => true,
                        'success' => false,
                    ])
                    ->visible(fn ($record) => $record && $record->rpr !== null),
                BadgeColumn::make('hiv')
                    ->label('HIV')
                    ->formatStateUsing(fn ($state) => $state ? 'Positive' : 'Negative')
                    ->colors([
                        'danger' => true,
                        'success' => false,
                    ])
                    ->visible(fn ($record) => $record && $record->hiv !== null),
                TextColumn::make('discharge_status')
                    ->label('Discharge Status')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'normal' => 'Normal Delivery',
                        'cesarean' => 'Cesarean Section',
                        'assisted' => 'Assisted Delivery',
                        'referred' => 'Referred',
                        'ama' => 'Against Medical Advice',
                        default => $state,
                    })
                    ->visible(fn ($record) => $record && $record->discharge_status !== null),
                TextColumn::make('baby_status')
                    ->label('Baby Status')
                    ->formatStateUsing(fn ($state) => match($state) {
                        'live_birth' => 'Live Birth',
                        'stillbirth' => 'Stillbirth',
                        'multiple_birth' => 'Multiple Birth',
                        default => $state,
                    })
                    ->visible(fn ($record) => $record && $record->baby_status !== null),
            ])
            ->filters([
                SelectFilter::make('form_type')
                    ->label('Form Type')
                    ->options([
                        'admission_consent' => 'Admission Consent',
                        'admission_discharge' => 'Admission and Discharge',
                    ]),
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ])
            ->heading(
                new HtmlString('<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 2.0rem;">Admissions</h1>')
            )
            ->headerActions([
               CreateAction::make('new_admission')
                ->label('New Admission')
                ->icon('heroicon-o-user-plus')
                ->modalHeading('Add New Admission')
                ->modalDescription('Please fill in the admission information below.')
                ->modalWidth('3xl')
                ->modalSubmitActionLabel('Save Admission')
            ->schema(fn ($form) => AdmissionForm::configure($form))
            ]);
    }
}

