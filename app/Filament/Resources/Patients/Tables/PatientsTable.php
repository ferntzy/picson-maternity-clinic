<?php

namespace App\Filament\Resources\Patients\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;

class PatientsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('userAccount.full_name')->label('Patient Name')
                    ->getStateUsing(function ($record) {
                        return $record->userAccount 
                            ? $record->userAccount->firstname . ' ' . $record->userAccount->lastname 
                            : 'No Name';
                    }),
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
            ]);
    }
}
