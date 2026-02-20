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
                                TextInput::make('profiles.first_name')
                                    ->label('First Name')
                                    ->placeholder('Enter first name')
                                    ->required()
                                    ->maxLength(100),

                                TextInput::make('profiles.middle_name')
                                    ->label('Middle Name')
                                    ->placeholder('Enter middle name (optional)')
                                    ->maxLength(100),

                                TextInput::make('profiles.last_name')
                                    ->label('Last Name')
                                    ->placeholder('Enter last name')
                                    ->required()
                                    ->maxLength(100),
                            ])
                            ->columns(1),
                        FileUpload::make('avatar')
                            ->label('Profile Picture')
                            ->image()
                            ->imageEditor()
                            ->avatar()
                            ->directory('avatars')
                            ->disk('public')
                            ->visibility('public')
                            ->preserveFilenames(false)
                            ->imagePreviewHeight('220')
                            ->nullable()
                            ->columnSpanFull()

                            ->dehydrateStateUsing(
                                fn($state) => $state instanceof \Illuminate\Http\UploadedFile
                                    ? $state->store('avatars', 'public')
                                    : $state
                            ),
                    ]),

                ComponentsSection::make('Account Information')
                    ->icon('heroicon-o-key')
                    ->collapsible()
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
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
