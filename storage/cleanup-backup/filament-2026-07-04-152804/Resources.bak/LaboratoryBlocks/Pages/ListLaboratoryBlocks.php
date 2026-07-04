<?php

namespace App\Filament\Resources\LaboratoryBlocks\Pages;

use App\Filament\Resources\LaboratoryBlocks\LaboratoryBlockResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaboratoryBlocks extends ListRecords
{
    protected static string $resource = LaboratoryBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
