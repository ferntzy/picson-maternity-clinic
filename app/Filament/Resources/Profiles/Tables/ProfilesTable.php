<?php

namespace App\Filament\Resources\Profiles\Tables;

use App\Filament\Resources\Profiles\Schemas\ProfileForm;
use App\Filament\Resources\Profiles\Schemas\ProfileInfolist;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ForceDeleteBulkAction;
use Filament\Actions\RestoreBulkAction;
use Filament\Actions\ViewAction;
use Filament\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;
use Filament\Notifications\Notification;


class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')
                    ->label('Full Name')
                    ->getStateUsing(fn ($record) =>
                        trim("{$record->firstname} {$record->middlename} {$record->lastname}")
                    )
                    ->searchable([
                        'firstname',
                        'middlename',
                        'lastname',
                    ]),

                TextColumn::make('address')
                    ->label('Address'),

                TextColumn::make('contact_num')
                    ->label('Contact Number'),
            ])
            // ->filters([
            //     TrashedFilter::make(),
            // ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->label('Edit Patient Profile')
                        ->color('gray')
                        ->modalHeading('Edit Patient Profile')
                        ->modalDescription('Update the patient information below.')
                        ->modalWidth('6xl')
                        ->modalSubmitActionLabel('Save Patient Profile')
                        ->modalSubmitAction(fn ($action) => $action
                            ->extraAttributes([
                                'style' => '
                                    background-color: #3e3bf7;
                                    color: white;
                                    border-radius: 8px;
                                    padding: 0.8rem 1.2rem;
                                    font-weight: 600;
                                    font-size: 0.875rem;
                                    border: none;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->modalCancelAction(fn ($action) => $action
                            ->extraAttributes([
                                'style' => '
                                    border: 1px solid #d1d5db;
                                    font-weight: 600;
                                    color: #374151;
                                    border-radius: 8px;
                                    padding: 0.8rem 1.2rem;
                                    font-weight: 600;
                                    font-size: 0.875rem;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->schema(fn ($form) => ProfileForm::configure($form)),

                    DeleteAction::make()
                        ->color('danger'),

                    ViewAction::make()
                        ->modalHeading('Patient Profile')
                        ->modalWidth('4xl')
                        ->modalSubmitAction(false)
                        ->modalCancelActionLabel('Close')
                        ->modalCancelAction(fn ($action) => $action
                            ->extraAttributes([
                                'style' => '
                                    border: 1px solid #d1d5db;
                                    font-weight: 600;
                                    color: #374151;
                                    border-radius: 8px;
                                    padding: 0.8rem 1.2rem;
                                    font-weight: 600;
                                    font-size: 0.875rem;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->schema(fn ($infolist) => ProfileInfolist::configure($infolist)),

                    // ── Custom Birth Emergency Action ──
                    Action::make('birth_emergency')
                        ->label('Birth and Emergency')
                        ->icon('heroicon-o-exclamation-triangle')
                        ->color('warning')
                        ->tooltip('Log urgent birth-related emergency')
                        ->modalHeading('Record Birth Emergency')
                        ->modalDescription('Capture critical details of the emergency birth situation.')
                        ->modalWidth('lg')
                        ->modalSubmitActionLabel('Save Emergency Record')
                        ->modalSubmitAction(fn ($action) => $action
                            ->extraAttributes([
                                'style' => '
                                    background-color: #f59e0b;
                                    color: white;
                                    border-radius: 8px;
                                    padding: 0.8rem 1.2rem;
                                    font-weight: 600;
                                    font-size: 0.875rem;
                                    border: none;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->modalCancelAction(fn ($action) => $action
                            ->extraAttributes([
                                'style' => '
                                    border: 1px solid #d1d5db;
                                    font-weight: 600;
                                    color: #374151;
                                    border-radius: 8px;
                                    padding: 0.8rem 1.2rem;
                                    font-weight: 600;
                                    font-size: 0.875rem;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->form([
                            \Filament\Forms\Components\DateTimePicker::make('occurred_at')
                                ->label('Date & Time of Emergency')
                                ->required()
                                ->default(now())
                                ->seconds(false),

                            \Filament\Forms\Components\Textarea::make('description')
                                ->label('Emergency Description')
                                ->rows(4)
                                ->required()
                                ->placeholder('Describe the situation, complications, interventions, etc.'),

                            \Filament\Forms\Components\Select::make('severity')
                                ->label('Severity Level')
                                ->options([
                                    'low'    => 'Low – Monitored',
                                    'medium' => 'Medium – Immediate attention',
                                    'high'   => 'High – Critical / Life-threatening',
                                ])
                                ->required(),

                            \Filament\Forms\Components\Select::make('outcome')
                                ->label('Immediate Outcome')
                                ->options([
                                    'stable'          => 'Mother & Baby Stable',
                                    'mother_stable'   => 'Mother Stable, Baby Needs Care',
                                    'baby_stable'     => 'Baby Stable, Mother Needs Care',
                                    'both_critical'   => 'Both Critical – Transferred',
                                    'deceased'        => 'Deceased',
                                ])
                                ->required(),

                            \Filament\Forms\Components\Textarea::make('notes')
                                ->label('Additional Notes / Follow-up')
                                ->rows(3),
                        ])
                        ->action(function (array $data, $record): void {
                            // Assuming a hasMany relationship: Profile has many BirthEmergency records
                            // Adjust according to your actual models/relationships
                            $record->birthEmergencies()?->create($data);

                            // Alternative: if storing directly on profile
                            // $record->update([
                            //     'last_emergency_at' => $data['occurred_at'],
                            //     'has_emergency_history' => true,
                            // ]);

                            Notification::make()
                                ->title('Birth emergency recorded successfully')
                                ->success()
                                ->send();
                        })
                        ->requiresConfirmation()
                ])
                ->icon('heroicon-m-ellipsis-vertical')
                ->color('gray')
                ->tooltip('Options')
                ->iconButton(),  // This makes the 3-dots appear as proper round icon button
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                    ForceDeleteBulkAction::make(),
                    RestoreBulkAction::make(),
                ]),
            ])
            ->heading(
                new HtmlString('<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 1.8rem;">Patient profiles</h1>')
            )
            ->headerActions([
                CreateAction::make('new_patient_profile')
                    ->label('New Patient Profile')
                    ->icon('heroicon-o-user-plus')
                    ->modalHeading('Add New Patient Profile')
                    ->modalDescription('Please fill in the admission information below.')
                    ->modalWidth('6xl')
                    ->modalSubmitActionLabel('Save Patient Profile')
                    ->createAnother(false)
                    ->extraAttributes([
                        'style' => '
                            background-color: #3e3bf7;
                            color: white;
                            border-radius: 8px;
                            padding: 0.8rem 1.2rem;
                            font-weight: 600;
                            font-size: 0.875rem;
                            border: none;
                            cursor: pointer;
                        '
                    ])
                    ->modalSubmitAction(fn ($action) => $action
                        ->extraAttributes([
                            'style' => '
                                background-color: #3e3bf7;
                                color: white;
                                border-radius: 8px;
                                padding: 0.8rem 1.2rem;
                                font-weight: 600;
                                font-size: 0.875rem;
                                border: none;
                                cursor: pointer;
                            '
                        ])
                    )
                    ->modalCancelAction(fn ($action) => $action
                        ->extraAttributes([
                            'style' => '
                                border: 1px solid #d1d5db;
                                font-weight: 600;
                                color: #374151;
                                border-radius: 8px;
                                padding: 0.8rem 1.2rem;
                                font-weight: 600;
                                font-size: 0.875rem;
                                cursor: pointer;
                            '
                        ])
                    )
                    ->schema(fn ($form) => ProfileForm::configure($form)),
            ]);
    }
}