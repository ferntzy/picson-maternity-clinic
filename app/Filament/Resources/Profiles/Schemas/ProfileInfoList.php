<?php

namespace App\Filament\Resources\Profiles\Schemas;

use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Components\ImageEntry;
use Filament\Infolists\Components\ViewEntry;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\View;
use Filament\Schemas\Schema;

class ProfileInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Avatar Header
                ViewEntry::make('avatar')
                    ->view('filament.infolists.patient-avatar'),

                // Personal Info Section
                Section::make('Personal Information')
                    ->icon('heroicon-o-user')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('firstname')
                                ->label('First Name'),

                            TextEntry::make('middlename')
                                ->label('Middle Name'),

                            TextEntry::make('lastname')
                                ->label('Last Name'),

                            TextEntry::make('birth_date')
                                ->label('Birth Date')
                                ->date(),

                            TextEntry::make('birth_place')
                                ->label('Birth Place'),

                            TextEntry::make('sex')
                                ->label('Gender')
                                ->badge()
                                ->color(fn ($state) => match($state) {
                                    'male'   => 'info',
                                    'female' => 'success',
                                    default  => 'gray',
                                }),

                            TextEntry::make('civil_status')
                                ->label('Civil Status')
                                ->badge()
                                ->color('gray'),

                            TextEntry::make('religion')
                                ->label('Religion')
                                ->placeholder('N/A'),

                            TextEntry::make('nationality')
                                ->label('Nationality'),
                        ]),
                    ]),

                // Contact Info Section
                Section::make('Contact Information')
                    ->icon('heroicon-o-phone')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('address')
                                ->label('Address'),

                            TextEntry::make('contact_num')
                                ->label('Contact Number'),

                            TextEntry::make('emergency_contact-name')
                                ->label('Emergency Contact Name')
                                ->placeholder('N/A'),

                            TextEntry::make('emergency_contact_number')
                                ->label('Emergency Contact Number')
                                ->placeholder('N/A'),
                        ]),
                    ]),

                // Medical Info Section
                Section::make('Medical Information')
                    ->icon('heroicon-o-heart')
                    ->schema([
                        Grid::make(3)->schema([
                            TextEntry::make('blood_type')
                                ->label('Blood Type')
                                ->badge()
                                ->color('danger'),

                            TextEntry::make('allergies')
                                ->label('Allergies')
                                ->badge()
                                ->color('warning')
                                ->placeholder('None'),
                        ]),
                    ]),
            ]);
    }
}