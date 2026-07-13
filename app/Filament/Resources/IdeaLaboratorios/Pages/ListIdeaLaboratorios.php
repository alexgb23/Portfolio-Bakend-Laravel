<?php

namespace App\Filament\Resources\IdeaLaboratorios\Pages;

use App\Filament\Resources\IdeaLaboratorios\IdeaLaboratorioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListIdeaLaboratorios extends ListRecords
{
    protected static string $resource = IdeaLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
