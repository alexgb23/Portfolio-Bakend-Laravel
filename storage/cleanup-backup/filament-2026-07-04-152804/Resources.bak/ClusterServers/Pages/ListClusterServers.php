<?php

namespace App\Filament\Resources\ClusterServers\Pages;

use App\Filament\Resources\ClusterServers\ClusterServerResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListClusterServers extends ListRecords
{
    protected static string $resource = ClusterServerResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
