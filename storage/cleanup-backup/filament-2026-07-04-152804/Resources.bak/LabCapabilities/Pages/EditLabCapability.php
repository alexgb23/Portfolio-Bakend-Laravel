<?php

namespace App\Filament\Resources\LabCapabilities\Pages;

use App\Filament\Resources\LabCapabilities\LabCapabilityResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLabCapability extends EditRecord
{
    protected static string $resource = LabCapabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
