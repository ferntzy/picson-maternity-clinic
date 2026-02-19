<?php

namespace App\Filament\Resources\Patients\Tables;

use App\Filament\Resources\Patients\Schemas\PatientForm;
use Filament\Actions\Action;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
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
                TextColumn::make('user.firstname')
                    ->label('Patient Name')
                    ->getStateUsing(fn ($record) =>
                        $record->user
                            ? trim("{$record->user->firstname} {$record->user->middlename} {$record->user->lastname}")
                            : 'No Name'
                    )
                    ->searchable(
                        query: function (Builder $query, string $search): Builder {
                            return $query->whereHas('user', function (Builder $q) use ($search) {
                                $q->where('firstname', 'like', "%{$search}%")
                                ->orWhere('middlename', 'like', "%{$search}%")
                                ->orWhere('lastname', 'like', "%{$search}%");
                            });
                        }
                    ),

                TextColumn::make('user.contact_num')  // <-- was contact_number, fix to contact_num
                    ->label('Contact Number'),
                TextColumn::make('address')
                    ->label('Address')
                    ->wrap(),
                TextColumn::make('spouse_name')
                    ->label('Emergency Contact Name'),

                TextColumn::make('spouse_contact_number')
                    ->label('Emergency Contact Number'),
            ])
            ->filters([
                TrashedFilter::make(),
            ])
            ->recordActions([
                ActionGroup::make([
                    Action::make('view')
                        ->label('View')
                        ->icon('heroicon-o-eye')
                        ->color('gray')
                        ->modalHeading('')
                        ->modalWidth('2xl')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Close')
                        ->modal(true)
                        ->schema(fn ($record) => [])
                        ->modalContent(fn ($record) => view('filament.patients.view-modal', ['record' => $record])),
                    EditAction::make()
                        ->modalHeading('Edit Patient')
                        ->modalDescription('Update the patient information below.')
                        ->modalWidth('6xl')
                        ->modalSubmitActionLabel('Save Changes')
                        ->schema(fn ($form) => PatientForm::configure($form))
                        ->color('gray'),
                    DeleteAction::make()
                ])->color('gray'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->heading(
                new HtmlString(
                    '<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 2rem;">
                        Patients
                     </h1>'
                )
            )
            ->headerActions([
                CreateAction::make('new_patient')
                    ->label('New Patient')
                    ->icon('heroicon-o-user-plus')
                    ->modalHeading('Add New Patient')
                    ->modalDescription('Please fill in the patient information below.')
                    ->modalWidth('6xl')
                    ->modalSubmitActionLabel('Save Patient')
                    ->schema(fn ($form) => PatientForm::configure($form)),
            ]);
    }
}
