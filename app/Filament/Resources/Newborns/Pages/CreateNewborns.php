<?php

namespace App\Filament\Resources\Newborns\Pages;

use App\Filament\Resources\Newborns\NewbornsResource;
use Filament\Resources\Pages\CreateRecord;

class CreateNewborns extends CreateRecord
{
    protected static string $resource = NewbornsResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
{
    return \App\Filament\Resources\Newborns\Schemas\NewbornsForm::handleDelivery($data);
}

}

