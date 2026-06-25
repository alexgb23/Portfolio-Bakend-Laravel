<?php

namespace App\Filament\Resources\HomeAssistantInstances\Pages;

use App\Filament\Resources\HomeAssistantInstances\HomeAssistantInstanceResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeAssistantInstances extends ListRecords
{
    protected static string $resource = HomeAssistantInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
