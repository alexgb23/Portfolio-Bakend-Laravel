<?php

namespace App\Filament\Resources\ProyectoDocumentacions\Pages;

use App\Filament\Resources\ProyectoDocumentacions\ProyectoDocumentacionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProyectoDocumentacions extends ListRecords
{
    protected static string $resource = ProyectoDocumentacionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
