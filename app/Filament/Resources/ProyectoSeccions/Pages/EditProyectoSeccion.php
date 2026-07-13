<?php

namespace App\Filament\Resources\ProyectoSeccions\Pages;

use App\Filament\Resources\ProyectoSeccions\ProyectoSeccionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProyectoSeccion extends EditRecord
{
    protected static string $resource = ProyectoSeccionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
