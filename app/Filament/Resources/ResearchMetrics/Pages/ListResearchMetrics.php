<?php

namespace App\Filament\Resources\ResearchMetrics\Pages;

use App\Filament\Resources\ResearchMetrics\ResearchMetricResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResearchMetrics extends ListRecords
{
    protected static string $resource = ResearchMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
