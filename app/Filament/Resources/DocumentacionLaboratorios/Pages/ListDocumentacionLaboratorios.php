<?php

namespace App\Filament\Resources\DocumentacionLaboratorios\Pages;

use App\Filament\Resources\DocumentacionLaboratorios\DocumentacionLaboratorioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListDocumentacionLaboratorios extends ListRecords
{
    protected static string $resource = DocumentacionLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
