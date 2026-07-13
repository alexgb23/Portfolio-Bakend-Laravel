<?php

namespace App\Filament\Resources\DocumentacionLaboratorios\Pages;

use App\Filament\Resources\DocumentacionLaboratorios\DocumentacionLaboratorioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditDocumentacionLaboratorio extends EditRecord
{
    protected static string $resource = DocumentacionLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
