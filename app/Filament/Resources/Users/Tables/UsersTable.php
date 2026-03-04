<?php

namespace App\Filament\Resources\Users\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class UsersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('avatar')
                    ->label('Profile Picture')
                    ->disk('public')
                    ->circular()
                    ->size(50)
                     ->defaultImageUrl(asset('images/default-avatar.svg'))
                    ->extraImgAttributes(['loading' => 'lazy']),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(['firstname', 'middlename', 'lastname'])
                    ->sortable(['firstname', 'lastname'])
                    ->formatStateUsing(fn($state) => $state ?: '—'),
                TextColumn::make('email')
                    ->label('Email ')
                    ->searchable(),
                TextColumn::make('profile.role')
                    ->label('Role')
                    ->badge()
                    ->color(fn (string $state): string => match ($state) {
                        'admin' => 'danger',
                        'director' => 'info',
                        'doctor' => 'warning',
                        'nurse' => 'success',
                        'patient' => 'gray',
                        default => 'gray',
                    })
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
