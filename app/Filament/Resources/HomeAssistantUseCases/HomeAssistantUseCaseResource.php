<?php

namespace App\Filament\Resources\HomeAssistantUseCases;

use App\Filament\Resources\HomeAssistantUseCases\Pages\CreateHomeAssistantUseCase;
use App\Filament\Resources\HomeAssistantUseCases\Pages\EditHomeAssistantUseCase;
use App\Filament\Resources\HomeAssistantUseCases\Pages\ListHomeAssistantUseCases;
use App\Filament\Resources\HomeAssistantUseCases\Schemas\HomeAssistantUseCaseForm;
use App\Filament\Resources\HomeAssistantUseCases\Tables\HomeAssistantUseCasesTable;
use App\Models\HomeAssistantUseCase;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class HomeAssistantUseCaseResource extends Resource
{
    protected static ?string $model = HomeAssistantUseCase::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    public static function form(Schema $schema): Schema
    {
        return HomeAssistantUseCaseForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return HomeAssistantUseCasesTable::configure($table);
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
            'index' => ListHomeAssistantUseCases::route('/'),
            'create' => CreateHomeAssistantUseCase::route('/create'),
            'edit' => EditHomeAssistantUseCase::route('/{record}/edit'),
        ];
    }
}
