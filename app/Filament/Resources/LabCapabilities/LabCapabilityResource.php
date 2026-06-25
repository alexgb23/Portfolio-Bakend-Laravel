<?php

namespace App\Filament\Resources\LabCapabilities;

use App\Filament\Resources\LabCapabilities\Pages\CreateLabCapability;
use App\Filament\Resources\LabCapabilities\Pages\EditLabCapability;
use App\Filament\Resources\LabCapabilities\Pages\ListLabCapabilities;
use App\Filament\Resources\LabCapabilities\Schemas\LabCapabilityForm;
use App\Filament\Resources\LabCapabilities\Tables\LabCapabilitiesTable;
use App\Models\LabCapability;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LabCapabilityResource extends Resource
{
    protected static ?string $model = LabCapability::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return LabCapabilityForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LabCapabilitiesTable::configure($table);
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
            'index' => ListLabCapabilities::route('/'),
            'create' => CreateLabCapability::route('/create'),
            'edit' => EditLabCapability::route('/{record}/edit'),
        ];
    }
}
