<?php

namespace App\Filament\Resources\LocalAiSetups;

use App\Filament\Resources\LocalAiSetups\Pages\CreateLocalAiSetup;
use App\Filament\Resources\LocalAiSetups\Pages\EditLocalAiSetup;
use App\Filament\Resources\LocalAiSetups\Pages\ListLocalAiSetups;
use App\Filament\Resources\LocalAiSetups\Schemas\LocalAiSetupForm;
use App\Filament\Resources\LocalAiSetups\Tables\LocalAiSetupsTable;
use App\Models\LocalAiSetup;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class LocalAiSetupResource extends Resource
{
    protected static ?string $model = LocalAiSetup::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Schema $schema): Schema
    {
        return LocalAiSetupForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return LocalAiSetupsTable::configure($table);
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
            'index' => ListLocalAiSetups::route('/'),
            'create' => CreateLocalAiSetup::route('/create'),
            'edit' => EditLocalAiSetup::route('/{record}/edit'),
        ];
    }
}
