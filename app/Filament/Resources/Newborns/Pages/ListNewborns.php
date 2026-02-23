<?php

namespace App\Filament\Resources\Newborns\Pages;

use App\Filament\Resources\Newborns\NewbornsResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListNewborns extends ListRecords
{
    protected static string $resource = NewbornsResource::class;


    public function getTitle(): string
    {
        return '';
    }


    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
