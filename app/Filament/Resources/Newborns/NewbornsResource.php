<?php

namespace App\Filament\Resources\Newborns;

use App\Filament\Resources\Newborns\Pages\CreateNewborns;
use App\Filament\Resources\Newborns\Pages\EditNewborns;
use App\Filament\Resources\Newborns\Pages\ListNewborns;
use App\Filament\Resources\Newborns\Pages\ViewNewborns;
use App\Filament\Resources\Newborns\Schemas\NewbornsForm;
use App\Filament\Resources\Newborns\Schemas\NewbornsInfolist;
use App\Filament\Resources\Newborns\Tables\NewbornsTable;
use App\Models\Newborns;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class NewbornsResource extends Resource
{
    protected static ?string $model = Newborns::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'newborns';

    public static function form(Schema $schema): Schema
    {
        return NewbornsForm::configure($schema);
    }

    public static function infolist(Schema $schema): Schema
    {
        return NewbornsInfolist::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return NewbornsTable::configure($table);
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
            'index' => ListNewborns::route('/'),
            //'create' => CreateNewborns::route('/create'),
            // 'view' => ViewNewborns::route('/{record}'),
            //'edit' => EditNewborns::route('/{record}/edit'),
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
