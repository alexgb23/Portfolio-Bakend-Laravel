<?php

namespace App\Filament\Resources\ResearchMetrics;

use App\Filament\Resources\ResearchMetrics\Pages\CreateResearchMetric;
use App\Filament\Resources\ResearchMetrics\Pages\EditResearchMetric;
use App\Filament\Resources\ResearchMetrics\Pages\ListResearchMetrics;
use App\Filament\Resources\ResearchMetrics\Schemas\ResearchMetricForm;
use App\Filament\Resources\ResearchMetrics\Tables\ResearchMetricsTable;
use App\Models\ResearchMetric;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ResearchMetricResource extends Resource
{
    protected static ?string $model = ResearchMetric::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'metric_name';

    public static function form(Schema $schema): Schema
    {
        return ResearchMetricForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ResearchMetricsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListResearchMetrics::route('/'),
            'create' => CreateResearchMetric::route('/create'),
            'edit' => EditResearchMetric::route('/{record}/edit'),
        ];
    }
}
