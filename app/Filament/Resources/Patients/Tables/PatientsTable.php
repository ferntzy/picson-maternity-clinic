<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Filament\Resources\Patients\Schemas\PatientForm;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\HtmlString;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userAccount.full_name')
                    ->label('Patient Name')
                    ->getStateUsing(fn ($record) =>
                        $record->userAccount
                            ? "{$record->userAccount->firstname} {$record->userAccount->lastname}"
                            : 'No Name'
                    )
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->whereHas('userAccount', function (Builder $q) use ($search) {
                                $q->where('firstname', 'like', "%{$search}%")
                                ->orWhere('middlename', 'like', "%{$search}%")
                                ->orWhere('lastname', 'like', "%{$search}%");
                            });
                        }
                    ),
                TextColumn::make('address')->label('Address')->extraAttributes(['class' => 'font-poppins text-2xl']),
                TextColumn::make('contact_number')->label('Contact Number'),
                TextColumn::make('spouse_name')->label('Emergency Contact Name'),
                TextColumn::make('spouse_contact_number')->label('Emergency Contact Number')
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->heading(
                new HtmlString('<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 2.0rem;">Patients</h1>')
            )
            ->headerActions([
               CreateAction::make('new_patient')
                ->label('New Patient')
                ->icon('heroicon-o-user-plus')
                ->modalHeading('Add New Patient')
                ->modalSubmitActionLabel('Save Patient')
                ->schema(fn ($form) => PatientForm::configure($form))
            ]);
    }
}
