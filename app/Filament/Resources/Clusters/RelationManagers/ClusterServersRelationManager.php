<?php

namespace App\Filament\Resources\Clusters\RelationManagers;

use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Validation\Rules\Unique;

class ClusterServersRelationManager extends RelationManager
{
    protected static string $relationship = 'clusterServers';

    protected static ?string $title = 'Cluster servers';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('server_id')
                    ->label('Servidor')
                    ->relationship('server', 'display_name')
                    ->searchable()
                    ->preload()
                    ->required()
                    ->rule(function (?object $record) {
                        return (new Unique('cluster_server', 'server_id'))
                            ->where('cluster_id', $this->getOwnerRecord()->getKey())
                            ->ignore($record?->getKey());
                    }),

                Select::make('node_role')
                    ->label('Node role')
                    ->options([
                        'manager' => 'Manager',
                        'worker' => 'Worker',
                        'hypervisor' => 'Hypervisor',
                        'quorum' => 'Quorum',
                        'backup' => 'Backup',
                    ])
                    ->searchable()
                    ->native(false),

                TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->default(0)
                    ->required(),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('server.display_name')
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('server.display_name')
                    ->label('Servidor')
                    ->searchable()
                    ->sortable()
                    ->weight('bold')
                    ->placeholder('-'),

                TextColumn::make('server.hostname')
                    ->label('Hostname')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('server.role')
                    ->label('Role')
                    ->badge()
                    ->searchable()
                    ->sortable(),

                TextColumn::make('node_role')
                    ->label('Node role')
                    ->badge()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),
            ])
            ->headerActions([
                CreateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                DeleteBulkAction::make(),
            ]);
    }
}
