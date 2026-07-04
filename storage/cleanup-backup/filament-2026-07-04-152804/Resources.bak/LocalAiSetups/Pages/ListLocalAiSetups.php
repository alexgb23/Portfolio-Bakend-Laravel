<?php

namespace App\Filament\Resources\LocalAiSetups\Pages;

use App\Filament\Resources\LocalAiSetups\LocalAiSetupResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListLocalAiSetups extends ListRecords
{
    protected static string $resource = LocalAiSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
