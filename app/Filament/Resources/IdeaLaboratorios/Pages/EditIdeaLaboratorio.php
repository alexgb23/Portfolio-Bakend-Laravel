<?php

namespace App\Filament\Resources\IdeaLaboratorios\Pages;

use App\Filament\Resources\IdeaLaboratorios\IdeaLaboratorioResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditIdeaLaboratorio extends EditRecord
{
    protected static string $resource = IdeaLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
