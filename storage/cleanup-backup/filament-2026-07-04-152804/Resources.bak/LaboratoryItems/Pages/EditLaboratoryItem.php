<?php

namespace App\Filament\Resources\LaboratoryItems\Pages;

use App\Filament\Resources\LaboratoryItems\LaboratoryItemResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaboratoryItem extends EditRecord
{
    protected static string $resource = LaboratoryItemResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
