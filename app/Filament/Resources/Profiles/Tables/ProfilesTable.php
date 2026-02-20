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
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TrashedFilter;
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class ProfilesTable
{
    public static function configure(Table $table): Table
    {
        return $table  
            ->columns([
                TextColumn::make('firstname')
                    ->label('Full Name')
                    ->getStateUsing(fn ($record) => 
                        $record->firstname . ' ' . 
                        $record->middlename . ' ' . 
                        $record->lastname
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
            ->filters([
                TrashedFilter::make(),
            ])   
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
                        ->schema(fn ($infolist) => ProfileInfolist::configure($infolist)),
                ])
                ->icon('heroicon-m-ellipsis-vertical')  // the 3-dot icon
                ->color('gray')
                ->tooltip('Options'),
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
                ->schema(fn ($form) => ProfileForm::configure($form))
            ]);
    }
}
