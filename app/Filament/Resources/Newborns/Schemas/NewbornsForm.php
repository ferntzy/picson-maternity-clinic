<?php

namespace App\Filament\Resources\Newborns\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\TimePicker;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;


class NewbornsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                Text::make('Delivery Details')
                    ->extraAttributes(['class' => 'text-lg font-semibold']),

                // Delivery and Basic Info
                Grid::make(12)->components([
                    Select::make('delivery_type')
                        ->label("Select Delivery Type")
                        ->options([
                            'Normal' => 'Normal',
                            'Cesarian' => 'Cesarian',
                        ])
                        ->default('Normal')
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem;'])
                        ->columnSpan(4),

                    TimePicker::make('time_of_delivery')
                        ->label('Time of Delivery')
                        ->required()
                        ->seconds(false)
                        ->columnSpan(4),
                ]),

                Text::make('Newborn Details')
                    ->extraAttributes(['class' => 'text-lg font-semibold']),

                // Newborn Name
                Grid::make(12)->components([
                    TextInput::make('firstname')
                        ->label('First Name')
                        ->required()
                        ->placeholder("Enter Newborn's first name")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('middlename')
                        ->label('Middle Name')
                        ->columnSpan(4)
                        ->placeholder("Enter newborn's middle name")
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('lastname')
                        ->label('Last Name')
                        ->required()
                        ->placeholder("Enter newborn's last name")
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
                        ->step('0.01')
                        ->placeholder("Enter newborn's weight")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('length')
                        ->label('Length (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->placeholder("Enter newborn's length")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('head')
                        ->label('Head Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->placeholder("Enter newborn's head circumference")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                ]),

                Grid::make(12)->components([
                    TextInput::make('chest')
                        ->label('Chest Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->placeholder("Enter newborn's chest circumference")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    TextInput::make('abdomen')
                        ->label('Abdomen Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->placeholder("Enter newborn's abdomen circumference")
                        ->columnSpan(4)
                        ->extraInputAttributes([
                            'style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;'
                        ]),

                    DatePicker::make('newborn_screening_done')
                        ->label('New born screening done')
                        ->required()
                        ->displayFormat('F j, Y') // Example: January 13, 2003
                        ->columnSpan(4)
                ]),
            ]);
    }
}
