<?php

namespace App\Filament\Resources\ProyectoAdjuntos\Pages;

use App\Filament\Resources\ProyectoAdjuntos\ProyectoAdjuntoResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProyectoAdjuntos extends ListRecords
{
    protected static string $resource = ProyectoAdjuntoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
