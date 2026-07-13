<?php

namespace App\Filament\Resources\ProyectoDocumentacions\Pages;

use App\Filament\Resources\ProyectoDocumentacions\ProyectoDocumentacionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProyectoDocumentacion extends EditRecord
{
    protected static string $resource = ProyectoDocumentacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
