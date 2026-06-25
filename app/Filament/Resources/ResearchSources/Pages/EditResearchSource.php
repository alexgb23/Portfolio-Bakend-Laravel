<?php

namespace App\Filament\Resources\ResearchSources\Pages;

use App\Filament\Resources\ResearchSources\ResearchSourceResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditResearchSource extends EditRecord
{
    protected static string $resource = ResearchSourceResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
