<?php

namespace App\Filament\Resources\ResearchSources;

use App\Filament\Resources\ResearchSources\Pages\CreateResearchSource;
use App\Filament\Resources\ResearchSources\Pages\EditResearchSource;
use App\Filament\Resources\ResearchSources\Pages\ListResearchSources;
use App\Filament\Resources\ResearchSources\RelationManagers\ResearchMetricsRelationManager;
use App\Filament\Resources\ResearchSources\Schemas\ResearchSourceForm;
use App\Filament\Resources\ResearchSources\Tables\ResearchSourcesTable;
use App\Models\ResearchSource;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResearchSourceResource extends Resource
{
    protected static ?string $model = ResearchSource::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'title';

    protected static ?string $navigationLabel = 'Research Sources';

    protected static ?string $modelLabel = 'Research Source';

    protected static ?string $pluralModelLabel = 'Research Sources';

    public static function form(Schema $schema): Schema
    {
        return ResearchSourceForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchSourcesTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            ResearchMetricsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResearchSources::route('/'),
            'create' => CreateResearchSource::route('/create'),
            'edit' => EditResearchSource::route('/{record}/edit'),
        ];
    }
}
