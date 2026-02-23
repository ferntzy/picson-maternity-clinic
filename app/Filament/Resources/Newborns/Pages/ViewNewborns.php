<?php

namespace App\Filament\Resources\Newborns\Pages;

use App\Filament\Resources\Newborns\NewbornsResource;
use Filament\Actions\EditAction;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\Newborns\Schemas\NewbornInfolist;


class ViewNewborns extends ViewRecord
{
    protected static string $resource = NewbornsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            EditAction::make(),
        ];
    }
    
}
