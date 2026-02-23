<?php

namespace App\Filament\Resources\Deliveries;

use App\Filament\Resources\Deliveries\Pages\CreateDeliveries;
use App\Filament\Resources\Deliveries\Pages\EditDeliveries;
use App\Filament\Resources\Deliveries\Pages\ListDeliveries;
use App\Filament\Resources\Deliveries\Pages\ViewDeliveries;
use App\Filament\Resources\Deliveries\Schemas\DeliveriesForm;
use App\Filament\Resources\Deliveries\Schemas\DeliveriesInfolist;
use App\Filament\Resources\Deliveries\Tables\DeliveriesTable;
use App\Models\Deliveries;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DeliveriesResource extends Resource
{
    protected static ?string $model = Deliveries::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    public static function form(Schema $schema): Schema
    {
        return DeliveriesForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return DeliveriesInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return DeliveriesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListDeliveries::route('/'),
            'create' => CreateDeliveries::route('/create'),
            'view' => ViewDeliveries::route('/{record}'),
            'edit' => EditDeliveries::route('/{record}/edit'),
        ];
    }

    public static function getRecordRouteBindingEloquentQuery(): Builder
    {
        return parent::getRecordRouteBindingEloquentQuery()
            ->withoutGlobalScopes([
                SoftDeletingScope::class,
            ]);
    }
}
