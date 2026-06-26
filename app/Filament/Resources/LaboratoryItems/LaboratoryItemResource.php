<?php

namespace App\Filament\Resources\LaboratoryItems;

use App\Filament\Resources\LaboratoryItems\Pages\CreateLaboratoryItem;
use App\Filament\Resources\LaboratoryItems\Pages\EditLaboratoryItem;
use App\Filament\Resources\LaboratoryItems\Pages\ListLaboratoryItems;
use App\Filament\Resources\LaboratoryItems\Schemas\LaboratoryItemForm;
use App\Filament\Resources\LaboratoryItems\Tables\LaboratoryItemsTable;
use App\Models\LaboratoryItem;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LaboratoryItemResource extends Resource
{
    protected static ?string $model = LaboratoryItem::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    protected static ?string $navigationLabel = 'Laboratory Items';

    protected static ?string $modelLabel = 'Laboratory Item';

    protected static ?string $pluralModelLabel = 'Laboratory Items';

    public static function form(Schema $schema): Schema
    {
        return LaboratoryItemForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LaboratoryItemsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListLaboratoryItems::route('/'),
            'create' => CreateLaboratoryItem::route('/create'),
            'edit' => EditLaboratoryItem::route('/{record}/edit'),
        ];
    }
}
