<?php

namespace App\Filament\Resources\LabCapabilities\Pages;

use App\Filament\Resources\LabCapabilities\LabCapabilityResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLabCapabilities extends ListRecords
{
    protected static string $resource = LabCapabilityResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
