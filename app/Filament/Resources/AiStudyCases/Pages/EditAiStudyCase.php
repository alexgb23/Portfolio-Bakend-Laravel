<?php

namespace App\Filament\Resources\AiStudyCases\Pages;

use App\Filament\Resources\AiStudyCases\AiStudyCaseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditAiStudyCase extends EditRecord
{
    protected static string $resource = AiStudyCaseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
