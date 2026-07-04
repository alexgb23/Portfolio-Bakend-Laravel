<?php

namespace App\Filament\Resources\HomeAssistantUseCases\Pages;

use App\Filament\Resources\HomeAssistantUseCases\HomeAssistantUseCaseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeAssistantUseCase extends EditRecord
{
    protected static string $resource = HomeAssistantUseCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
