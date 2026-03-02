<?php

namespace App\Filament\Resources\Users\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Section;
use Filament\Schemas\Schema;
use Filament\Schemas\Components\Section as ComponentsSection;
use Filament\Support\Icons\Heroicon;
use App\Models\Profiles;

class UserForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                // Profile section for CREATE mode
                ComponentsSection::make('Profile Selection')
                    ->icon(Heroicon::OutlinedUser)
                    ->collapsible()
                    ->visible(fn($record) => $record === null) // Only show on create
                    ->schema([
                        Select::make('profile_id')
                            ->label('Select Profile')
                            ->placeholder('Choose an existing profile')
                            ->options(function () {
                                return Profiles::whereDoesntHave('user')
                                    ->get()
                                    ->mapWithKeys(fn($profile) => [$profile->id => $profile->fullname])
                                    ->toArray();
                            })
                            ->required()
                            ->columnSpanFull()
                            ->helperText('Profiles must be created first and have Google SSO configured'),
                    ]),

                // Personal Information section
                ComponentsSection::make('Personal Information')
                    ->icon(Heroicon::OutlinedUser)
                    ->collapsible()
                    ->visible(fn($record) => $record !== null) // Only show on edit
                    ->columns(2)
                    ->schema([
                        TextInput::make('profile.firstname')
                            ->label('First Name')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('profile.middlename')
                            ->label('Middle Name')
                            ->maxLength(255),

                        TextInput::make('profile.lastname')
                            ->label('Last Name')
                            ->required()
                            ->maxLength(255),

                        DatePicker::make('profile.birth_date')
                            ->label('Birth Date')
                            ->native(false),

                        Select::make('profile.sex')
                            ->label('Sex')
                            ->options([
                                'M' => 'Male',
                                'F' => 'Female',
                                'O' => 'Other',
                            ]),

                        TextInput::make('profile.birth_place')
                            ->label('Birth Place')
                            ->maxLength(255),

                        Select::make('profile.civil_status')
                            ->label('Civil Status')
                            ->options([
                                'Single' => 'Single',
                                'Married' => 'Married',
                                'Divorced' => 'Divorced',
                                'Widowed' => 'Widowed',
                                'Separated' => 'Separated',
                            ]),

                        TextInput::make('profile.nationality')
                            ->label('Nationality')
                            ->maxLength(255),

                        TextInput::make('profile.religion')
                            ->label('Religion')
                            ->maxLength(255),
                    ]),

                // Contact Information section
                ComponentsSection::make('Contact Information')
                    ->icon('heroicon-o-phone')
                    ->collapsible()
                    ->visible(fn($record) => $record !== null) // Only show on edit
                    ->columns(2)
                    ->schema([
                        Textarea::make('profile.address')
                            ->label('Address')
                            ->maxLength(255)
                            ->rows(3)
                            ->columnSpanFull(),

                        TextInput::make('profile.contact_num')
                            ->label('Contact Number')
                            ->tel()
                            ->maxLength(255),

                        TextInput::make('profile.emergency_contact_name')
                            ->label('Emergency Contact Name')
                            ->maxLength(255),

                        TextInput::make('profile.emergency_contact_number')
                            ->label('Emergency Contact Number')
                            ->tel()
                            ->maxLength(255),
                    ]),

                // Medical Information section
                ComponentsSection::make('Medical Information')
                    ->icon('heroicon-o-heart')
                    ->collapsible()
                    ->visible(fn($record) => $record !== null) // Only show on edit
                    ->columns(2)
                    ->schema([
                        TextInput::make('profile.philhealth_number')
                            ->label('PhilHealth Number')
                            ->maxLength(255),

                        Select::make('profile.blood_type')
                            ->label('Blood Type')
                            ->options([
                                'A+' => 'A+',
                                'A-' => 'A-',
                                'B+' => 'B+',
                                'B-' => 'B-',
                                'AB+' => 'AB+',
                                'AB-' => 'AB-',
                                'O+' => 'O+',
                                'O-' => 'O-',
                            ]),

                        Textarea::make('profile.allergies')
                            ->label('Allergies')
                            ->maxLength(255)
                            ->rows(3)
                            ->columnSpanFull(),
                    ]),

                // Role section
                ComponentsSection::make('Role & Permissions')
                    ->icon('heroicon-o-key')
                    ->collapsible()
                    ->visible(fn($record) => $record === null) // Only show on create
                    ->schema([
                        Select::make('profile.role')
                            ->label('Role')
                            ->options([
                                'admin' => 'Admin',
                                'director' => 'Director',
                                'doctor' => 'Doctor',
                                'nurse' => 'Nurse',
                                'patient' => 'Patient',
                            ])
                            ->required(),
                    ]),

                // Role section (edit mode)
                ComponentsSection::make('Role & Permissions')
                    ->icon('heroicon-o-key')
                    ->collapsible()
                    ->visible(fn($record) => $record !== null) // Only show on edit
                    ->schema([
                        Select::make('profile.role')
                            ->label('Role')
                            ->options([
                                'admin' => 'Admin',
                                'director' => 'Director',
                                'doctor' => 'Doctor',
                                'nurse' => 'Nurse',
                                'patient' => 'Patient',
                            ])
                            ->required(),
                    ]),

                // Account Information section
                ComponentsSection::make('Account Information')
                    ->icon('heroicon-o-envelope')
                    ->collapsible()
                    ->columns(1)
                    ->schema([
                        TextInput::make('email')
                            ->label('Email Address')
                            ->email()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true)
                            ->required()
                            ->helperText('This will be verified via Google SSO'),

                        TextInput::make('password')
                            ->password()
                            ->label('Password')
                            ->required(fn($record) => $record === null) // Required only on create
                            ->dehydrated(fn($state): bool => filled($state))
                            ->minLength(8)
                            ->revealable(),

                        TextInput::make('password_confirmation')
                            ->password()
                            ->label('Confirm Password')
                            ->required(fn($record) => $record === null) // Required only on create
                            ->same('password')
                            ->dehydrated(false)
                            ->minLength(8)
                            ->revealable(),

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
            ]);
    }
}
