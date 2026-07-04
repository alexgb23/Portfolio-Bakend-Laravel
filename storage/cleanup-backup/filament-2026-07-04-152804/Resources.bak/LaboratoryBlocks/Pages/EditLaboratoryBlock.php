<?php

namespace App\Filament\Resources\LaboratoryBlocks\Pages;

use App\Filament\Resources\LaboratoryBlocks\LaboratoryBlockResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaboratoryBlock extends EditRecord
{
    protected static string $resource = LaboratoryBlockResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
