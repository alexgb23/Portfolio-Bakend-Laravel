<?php

namespace App\Filament\Resources\ProfileHighlights\Pages;

use App\Filament\Resources\ProfileHighlights\ProfileHighlightResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfileHighlights extends ListRecords
{
    protected static string $resource = ProfileHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
