<?php

namespace App\Filament\Resources\Deliveries\Schemas;

use App\Models\Deliveries;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;

class DeliveriesInfolist
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextEntry::make('time_of_delivery')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('type_of_delivery')
                    ->placeholder('-'),
                TextEntry::make('profile_id')
                    ->numeric()
                    ->placeholder('-'),
                TextEntry::make('created_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('updated_at')
                    ->dateTime()
                    ->placeholder('-'),
                TextEntry::make('deleted_at')
                    ->dateTime()
                    ->visible(fn (Deliveries $record): bool => $record->trashed()),
            ]);
    }
}
