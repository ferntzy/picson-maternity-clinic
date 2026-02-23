<?php

namespace App\Filament\Resources\Newborns\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class NewbornsInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Header Section
                // ViewEntry::make('header')
                //     ->view('filament.infolists.newborn-header-placeholder'), 
                    // Placeholder, can keep empty, actual data shown below

                // Personal Info Section
                Section::make('Newborn Information')
                    ->icon('heroicon-o-heart')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('firstname')->label('First Name'),
                            TextEntry::make('middlename')->label('Middle Name'),
                            TextEntry::make('lastname')->label('Last Name'),
                            TextEntry::make('sex')->label('Gender')->badge(),
                            TextEntry::make('date_time_of_birth')
                                ->label('Date & Time of Birth')
                                ->dateTime(),
                        ]),
                    ]),

                // Delivery Section
                Section::make('Delivery Information')
                    ->icon('heroicon-o-home')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('delivery.type_of_delivery')
                                ->label('Delivery Type')
                                ->placeholder('N/A'),
                            TextEntry::make('delivery.time_of_delivery')
                                ->label('Time of Delivery')
                                ->dateTime()
                                ->placeholder('N/A'),
                        ]),
                    ]),

                // Measurements Section
                Section::make('Measurements')
                    ->icon('heroicon-o-scale')
                    ->schema([
                        Grid::make(4)->schema([
                            TextEntry::make('birth_weight')->label('Weight (kg)'),
                            TextEntry::make('length')->label('Length (cm)'),
                            TextEntry::make('head')->label('Head (cm)'),
                            TextEntry::make('chest')->label('Chest (cm)'),
                            TextEntry::make('abdomen')->label('Abdomen (cm)'),
                        ]),
                    ]),

                // Apgar Scores
                Section::make('Apgar Scores')
                    ->icon('heroicon-o-heart')
                    ->schema([
                        Grid::make(2)->schema([
                            TextEntry::make('apgar_score_1')->label('Apgar (1 min)'),
                            TextEntry::make('apgar_score_5')->label('Apgar (5 min)'),
                        ]),
                    ]),

                // Screening Section
                Section::make('Newborn Screening')
                    ->icon('heroicon-o-document-check')
                    ->schema([
                        TextEntry::make('newborn_screening_done')
                            ->label('Screening Done')
                            ->badge()
                            ->color(fn ($state) => $state ? 'success' : 'danger')
                            ->formatStateUsing(fn ($state) => $state ? 'Yes' : 'No'),
                    ]),
            ]);
    }
}
