<?php

namespace App\Filament\Resources\Newborns\Tables;

use App\Filament\Resources\Newborns\Schemas\NewbornsForm;
use App\Filament\Resources\Newborns\Schemas\NewbornsInfolist;
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
use Filament\Tables\Table;
use Illuminate\Support\HtmlString;

class NewbornsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')
                    ->label('First Name')
                    ->searchable(),

                TextColumn::make('middlename')
                    ->label('Middle Name')
                    ->searchable(),

                TextColumn::make('lastname')
                    ->label('Last Name')
                    ->searchable(),

                TextColumn::make('date_time_of_birth')
                    ->label('Date & Time of Birth')
                    ->dateTime('F j, Y H:i')
                    ->sortable(),

                TextColumn::make('delivery.type_of_delivery')
                    ->label('Delivery')
                    ->sortable(),
            ])
            ->recordActions([
                ActionGroup::make([
                    EditAction::make()
                        ->label('Edit Newborn')
                        ->color('gray')
                        ->modalHeading('Edit Newborn Record')
                        ->modalDescription('Update the newborn information below.')
                        ->modalWidth('6xl')
                        ->modalSubmitActionLabel('Save Newborn Record')
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
                                    font-size: 0.875rem;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->schema(fn ($form) => NewbornsForm::configure($form)),

                    DeleteAction::make()->color('danger'),

                    ViewAction::make()
                        ->modalHeading('Newborn Record')
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
                                    font-size: 0.875rem;
                                    cursor: pointer;
                                '
                            ])
                        )
                        ->schema(fn ($infolist) => NewbornsInfolist::configure($infolist)),
                ])
                ->icon('heroicon-m-ellipsis-vertical')
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
                new HtmlString('<h1 style="font-family: Poppins, sans-serif; font-weight: 700; font-size: 1.8rem;">Newborns</h1>')
            )
            ->headerActions([
                CreateAction::make('new_newborn_record')
                    ->label('New Newborn')
                    ->icon('heroicon-o-user-plus')
                    ->modalHeading('Add New Newborn')
                    ->modalDescription('Fill in the newborn information below.')
                    ->modalWidth('6xl')
                    ->modalSubmitActionLabel('Save Newborn Record')
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
                                font-size: 0.875rem;
                                cursor: pointer;
                            '
                        ])
                    )
                    ->schema(fn ($form) => NewbornsForm::configure($form)),
            ]);
    }
}
