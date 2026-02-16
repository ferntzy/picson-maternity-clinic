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
                ImageColumn::make('pfp_url')
                    ->label('Profile Picture')
                    ->disk('public')
                    ->visibility('public')
                    ->circular()
                    ->size(50)
                    ->defaultImageUrl(asset('images/default-avatar.svg'))  // use asset() helper
                    ->extraImgAttributes(['loading' => 'lazy'])            // performance
                    ->getStateUsing(function ($record) {
                        // Optional: if your path is stored without 'avatars/' or wrong format
                        $path = $record->pfp_url;
                        return $path ? $path : null;  // or fix path here if needed
                    }),
                ImageColumn::make('profileurl')
                    ->label('profile'),
                TextColumn::make('full_name')
                    ->label('Full Name')
                    ->searchable(['firstname', 'middlename', 'lastname'])
                    ->sortable(['firstname', 'lastname'])
                    ->formatStateUsing(fn($state) => $state ?: '—'),
                TextColumn::make('email')
                    ->label('Email address')
                    ->searchable(),
                TextColumn::make('username')
                    ->label('User name')
                    ->searchable(),
                TextColumn::make('role')
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
