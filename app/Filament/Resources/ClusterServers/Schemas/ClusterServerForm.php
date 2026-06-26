<?php

namespace App\Filament\Resources\ClusterServers\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Validation\Rules\Unique;

class ClusterServerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Cluster server')
                    ->schema([
                        Select::make('cluster_id')
                            ->label('Cluster')
                            ->relationship('cluster', 'name')
                            ->searchable()
                            ->preload()
                            ->required(),

                        Select::make('server_id')
                            ->label('Servidor')
                            ->relationship('server', 'display_name')
                            ->searchable()
                            ->preload()
                            ->required()
                            ->rule(function (?object $record, callable $get) {
                                return (new Unique('cluster_server', 'server_id'))
                                    ->where('cluster_id', $get('cluster_id'))
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
                    ->columns(2),
            ]);
    }
}
