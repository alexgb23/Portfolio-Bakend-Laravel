<?php

namespace App\Filament\Resources\LaboratorioReals\Pages;

use App\Filament\Resources\LaboratorioReals\LaboratorioRealResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLaboratorioReals extends ListRecords
{
    protected static string $resource = LaboratorioRealResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
