<?php

namespace App\Filament\Resources\HomeAssistantInstances\Pages;

use App\Filament\Resources\HomeAssistantInstances\HomeAssistantInstanceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditHomeAssistantInstance extends EditRecord
{
    protected static string $resource = HomeAssistantInstanceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
