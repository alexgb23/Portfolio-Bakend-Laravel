<?php

namespace App\Filament\Resources\ResearchMetrics\Pages;

use App\Filament\Resources\ResearchMetrics\ResearchMetricResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResearchMetric extends EditRecord
{
    protected static string $resource = ResearchMetricResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
