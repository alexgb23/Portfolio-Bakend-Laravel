<?php

namespace App\Filament\Resources\ProfileSettings\Pages;

use App\Filament\Resources\ProfileSettings\ProfileSettingResource;
use Filament\Resources\Pages\CreateRecord;

class CreateProfileSetting extends CreateRecord
{
    protected static string $resource = ProfileSettingResource::class;
}
