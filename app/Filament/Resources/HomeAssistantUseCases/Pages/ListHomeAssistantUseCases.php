<?php

namespace App\Filament\Resources\HomeAssistantUseCases\Pages;

use App\Filament\Resources\HomeAssistantUseCases\HomeAssistantUseCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListHomeAssistantUseCases extends ListRecords
{
    protected static string $resource = HomeAssistantUseCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
