<?php

namespace App\Filament\Resources\ProfileExpertises\Pages;

use App\Filament\Resources\ProfileExpertises\ProfileExpertiseResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileExpertise extends EditRecord
{
    protected static string $resource = ProfileExpertiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
