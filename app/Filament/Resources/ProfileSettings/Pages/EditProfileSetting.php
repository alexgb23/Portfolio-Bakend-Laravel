<?php

namespace App\Filament\Resources\ProfileSettings\Pages;

use App\Filament\Resources\ProfileSettings\ProfileSettingResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditProfileSetting extends EditRecord
{
    protected static string $resource = ProfileSettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
