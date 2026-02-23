<?php

namespace App\Filament\Resources\Newborns\Schemas;

use App\Models\Deliveries;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Schema;

class NewbornsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Delivery and Basic Info
                Grid::make(12)->components([
                    Select::make('delivery_id')
                        ->label('Delivery')
                        ->relationship('delivery', 'id')
                        ->required()
                        ->options(
                            Deliveries::all()->pluck('type_of_delivery', 'id')
                        )
                        ->searchable()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    Select::make('sex')
                        ->label('Sex')
                        ->options([
                            'male' => 'Male',
                            'female' => 'Female',
                        ])
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    DateTimePicker::make('date_time_of_birth')
                        ->label('Date & Time of Birth')
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),
                ]),

                // Newborn Name
                Grid::make(12)->components([
                    TextInput::make('firstname')
                        ->label('First Name')
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('middlename')
                        ->label('Middle Name')
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('lastname')
                        ->label('Last Name')
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),
                ]),

                // Measurements
                Grid::make(12)->components([
                    TextInput::make('birth_weight')
                        ->label('Weight (kg)')
                        ->numeric()
                        ->required()
                        ->columnSpan(3)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('length')
                        ->label('Length (cm)')
                        ->numeric()
                        ->required()
                        ->columnSpan(3)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('head')
                        ->label('Head Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->columnSpan(2)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('chest')
                        ->label('Chest Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->columnSpan(2)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('abdomen')
                        ->label('Abdomen Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->columnSpan(2)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),
                ]),

                // Newborn Screening
                Grid::make(12)->components([
                    Select::make('newborn_screening_done')
                        ->label('Newborn Screening Done')
                        ->options([
                            1 => 'Yes',
                            0 => 'No',
                        ])
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),
                ]),
            ]);
    }
}
