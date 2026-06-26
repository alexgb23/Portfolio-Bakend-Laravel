<?php

namespace App\Filament\Resources\ProfileExpertises\Pages;

use App\Filament\Resources\ProfileExpertises\ProfileExpertiseResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListProfileExpertises extends ListRecords
{
    protected static string $resource = ProfileExpertiseResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
