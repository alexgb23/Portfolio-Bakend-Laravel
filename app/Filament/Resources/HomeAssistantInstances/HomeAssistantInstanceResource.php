<?php

namespace App\Filament\Resources\HomeAssistantInstances;

use App\Filament\Resources\HomeAssistantInstances\Pages\CreateHomeAssistantInstance;
use App\Filament\Resources\HomeAssistantInstances\Pages\EditHomeAssistantInstance;
use App\Filament\Resources\HomeAssistantInstances\Pages\ListHomeAssistantInstances;
use App\Filament\Resources\HomeAssistantInstances\Schemas\HomeAssistantInstanceForm;
use App\Filament\Resources\HomeAssistantInstances\Tables\HomeAssistantInstancesTable;
use App\Models\HomeAssistantInstance;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeAssistantInstanceResource extends Resource
{
    protected static ?string $model = HomeAssistantInstance::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return HomeAssistantInstanceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeAssistantInstancesTable::configure($table);
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
            'index' => ListHomeAssistantInstances::route('/'),
            'create' => CreateHomeAssistantInstance::route('/create'),
            'edit' => EditHomeAssistantInstance::route('/{record}/edit'),
        ];
    }
}
