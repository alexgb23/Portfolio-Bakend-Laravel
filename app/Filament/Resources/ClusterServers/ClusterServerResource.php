<?php

namespace App\Filament\Resources\ClusterServers;

use App\Filament\Resources\ClusterServers\Pages\CreateClusterServer;
use App\Filament\Resources\ClusterServers\Pages\EditClusterServer;
use App\Filament\Resources\ClusterServers\Pages\ListClusterServers;
use App\Filament\Resources\ClusterServers\Schemas\ClusterServerForm;
use App\Filament\Resources\ClusterServers\Tables\ClusterServersTable;
use App\Models\ClusterServer;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class ClusterServerResource extends Resource
{
    protected static ?string $model = ClusterServer::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedRectangleStack;

    protected static ?string $recordTitleAttribute = 'server_id';

    public static function form(Schema $schema): Schema
    {
        return ClusterServerForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return ClusterServersTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListClusterServers::route('/'),
            'create' => CreateClusterServer::route('/create'),
            'edit' => EditClusterServer::route('/{record}/edit'),
        ];
    }
}
