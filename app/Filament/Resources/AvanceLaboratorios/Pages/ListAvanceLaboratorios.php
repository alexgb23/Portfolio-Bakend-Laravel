<?php

namespace App\Filament\Resources\AvanceLaboratorios\Pages;

use App\Filament\Resources\AvanceLaboratorios\AvanceLaboratorioResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAvanceLaboratorios extends ListRecords
{
    protected static string $resource = AvanceLaboratorioResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
