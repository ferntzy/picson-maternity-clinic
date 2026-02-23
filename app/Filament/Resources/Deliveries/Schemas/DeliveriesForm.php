<?php

namespace App\Filament\Resources\Deliveries\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class DeliveriesForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                DateTimePicker::make('time_of_delivery'),
                TextInput::make('type_of_delivery'),
                TextInput::make('profile_id')
                    ->numeric(),
            ]);
    }
}
