<?php

namespace App\Filament\Resources\AdjuntoLaboratorios\Pages;

use App\Filament\Resources\AdjuntoLaboratorios\AdjuntoLaboratorioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAdjuntoLaboratorios extends ListRecords
{
    protected static string $resource = AdjuntoLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
