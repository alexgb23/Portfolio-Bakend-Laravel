<?php

namespace App\Filament\Resources\AiStudyCases\Pages;

use App\Filament\Resources\AiStudyCases\AiStudyCaseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListAiStudyCases extends ListRecords
{
    protected static string $resource = AiStudyCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
