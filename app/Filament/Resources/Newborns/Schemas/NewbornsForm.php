<?php

namespace App\Filament\Resources\Newborns\Schemas;

use App\Models\Deliveries;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Text;
use Filament\Schemas\Schema;

class NewbornsForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([

                // Delivery Details Section
                Text::make('Delivery Details')
                    ->extraAttributes(['class' => 'text-lg font-semibold']),

                Grid::make(12)->components([

                    // Editable type of delivery
                    Select::make('delivery_type')
                        ->label('Delivery Type')
                        ->options([
                            'vaginal' => 'Normal',
                            'cesarean' => 'Cesarian',
                        ])
                        ->required()
                        ->columnSpan(6)
                        ->afterStateUpdated(function ($state, callable $set, $get, $context) {
                            if ($get('delivery_id')) {
                                $delivery = Deliveries::find($get('delivery_id'));
                                if ($delivery) {
                                    $delivery->type_of_delivery = $state;
                                    $delivery->save();
                                }
                            }
                        }),

                    // Editable time of delivery
                    DateTimePicker::make('delivery_time')
                        ->label('Time of Delivery')
                        ->required()
                        ->seconds(false)
                        ->columnSpan(6)
                        ->afterStateUpdated(function ($state, callable $set, $get, $context) {
                            if ($get('delivery_id')) {
                                $delivery = Deliveries::find($get('delivery_id'));
                                if ($delivery) {
                                    $delivery->time_of_delivery = $state;
                                    $delivery->save();
                                }
                            }
                        }),
                ]),

                // Newborn Details Section
                Text::make('Newborn Details')
                    ->extraAttributes(['class' => 'text-lg font-semibold']),

                // Newborn Name
                Grid::make(12)->components([
                    TextInput::make('firstname')
                        ->label('First Name')
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    TextInput::make('middlename')
                        ->label('Middle Name')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    TextInput::make('lastname')
                        ->label('Last Name')
                        ->required()
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),
                ]),

                // Measurements
                Grid::make(12)->components([
                    TextInput::make('birth_weight')
                        ->label('Weight (kg)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    TextInput::make('length')
                        ->label('Length (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    TextInput::make('head')
                        ->label('Head Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),
                ]),

                Grid::make(12)->components([
                    TextInput::make('chest')
                        ->label('Chest Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    TextInput::make('abdomen')
                        ->label('Abdomen Circumference (cm)')
                        ->numeric()
                        ->required()
                        ->step('0.01')
                        ->columnSpan(4)
                        ->extraInputAttributes(['style' => 'height: 2.5rem; font-size: 0.875rem; padding:20px;']),

                    DatePicker::make('newborn_screening_done')
                        ->label('Newborn Screening Done')
                        ->required()
                        ->displayFormat('F j, Y')
                        ->columnSpan(4),
                ]),
            ]);
    }
}