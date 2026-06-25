<?php

namespace App\Filament\Resources\LaboratoryItems\Pages;

use App\Filament\Resources\LaboratoryItems\LaboratoryItemResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaboratoryItems extends ListRecords
{
    protected static string $resource = LaboratoryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
