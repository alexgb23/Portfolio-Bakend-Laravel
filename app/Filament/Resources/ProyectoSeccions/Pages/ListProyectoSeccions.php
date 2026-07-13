<?php

namespace App\Filament\Resources\ProyectoSeccions\Pages;

use App\Filament\Resources\ProyectoSeccions\ProyectoSeccionResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProyectoSeccions extends ListRecords
{
    protected static string $resource = ProyectoSeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
