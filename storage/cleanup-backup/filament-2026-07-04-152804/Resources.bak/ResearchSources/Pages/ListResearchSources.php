<?php

namespace App\Filament\Resources\ResearchSources\Pages;

use App\Filament\Resources\ResearchSources\ResearchSourceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListResearchSources extends ListRecords
{
    protected static string $resource = ResearchSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
