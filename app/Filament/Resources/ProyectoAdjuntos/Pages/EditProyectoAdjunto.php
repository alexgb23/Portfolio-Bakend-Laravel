<?php

namespace App\Filament\Resources\ProyectoAdjuntos\Pages;

use App\Filament\Resources\ProyectoAdjuntos\ProyectoAdjuntoResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProyectoAdjunto extends EditRecord
{
    protected static string $resource = ProyectoAdjuntoResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
