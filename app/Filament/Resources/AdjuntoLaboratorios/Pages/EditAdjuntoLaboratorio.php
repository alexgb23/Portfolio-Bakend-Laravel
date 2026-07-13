<?php

namespace App\Filament\Resources\AdjuntoLaboratorios\Pages;

use App\Filament\Resources\AdjuntoLaboratorios\AdjuntoLaboratorioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAdjuntoLaboratorio extends EditRecord
{
    protected static string $resource = AdjuntoLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
