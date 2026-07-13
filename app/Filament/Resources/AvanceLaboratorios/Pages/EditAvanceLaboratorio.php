<?php

namespace App\Filament\Resources\AvanceLaboratorios\Pages;

use App\Filament\Resources\AvanceLaboratorios\AvanceLaboratorioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAvanceLaboratorio extends EditRecord
{
    protected static string $resource = AvanceLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
