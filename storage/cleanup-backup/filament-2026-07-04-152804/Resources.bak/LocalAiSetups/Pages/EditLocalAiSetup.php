<?php

namespace App\Filament\Resources\LocalAiSetups\Pages;

use App\Filament\Resources\LocalAiSetups\LocalAiSetupResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditLocalAiSetup extends EditRecord
{
    protected static string $resource = LocalAiSetupResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
