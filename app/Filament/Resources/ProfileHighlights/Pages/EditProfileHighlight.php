<?php

namespace App\Filament\Resources\ProfileHighlights\Pages;

use App\Filament\Resources\ProfileHighlights\ProfileHighlightResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileHighlight extends EditRecord
{
    protected static string $resource = ProfileHighlightResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
