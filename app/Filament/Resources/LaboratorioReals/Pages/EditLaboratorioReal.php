<?php

namespace App\Filament\Resources\LaboratorioReals\Pages;

use App\Filament\Resources\LaboratorioReals\LaboratorioRealResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLaboratorioReal extends EditRecord
{
    protected static string $resource = LaboratorioRealResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
