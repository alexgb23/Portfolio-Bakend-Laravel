<?php

namespace App\Filament\Resources\ClusterServers\Pages;

use App\Filament\Resources\ClusterServers\ClusterServerResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditClusterServer extends EditRecord
{
    protected static string $resource = ClusterServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
