<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;
use Filament\Tables\Grouping\Group;
use Filament\Forms\Components\FileUpload;

use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\Section;
use Filament\Schemas\Components\Section as ComponentsSection;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                ComponentsSection::make('Personal Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->collapsible()
                    ->schema([
                        // Name fields in a grid
                        ComponentsSection::make()
                            ->schema([
                                TextInput::make('firstname')
                                    ->label('First Name')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('middlename')
                                    ->label('Middle Name')
                                    ->maxLength(100),

                                TextInput::make('lastname')
                                    ->label('Last Name')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->columns(3),

                        // Profile picture
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->preserveFilenames(false)
                            ->directory('avatars')
                            ->disk('public')
                            ->imagePreviewHeight('220')
                            ->nullable()
                            ->columnSpanFull(),
                    ]),

                ComponentsSection::make('Account Information')
                    ->icon('heroicon-o-key')
                    ->collapsible()
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        TextInput::make('username')
                            ->label('Username')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->alphaDash()           // only letters, numbers, dashes, underscores
                            ->minLength(4),

                        TextInput::make('role')
                            ->label('Role')
                            ->required()
                            ->maxLength(45),

                        TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->required(fn(string $context): bool => $context === 'create')
                            ->dehydrated(fn($state): bool => filled($state))
                            ->minLength(8)
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
