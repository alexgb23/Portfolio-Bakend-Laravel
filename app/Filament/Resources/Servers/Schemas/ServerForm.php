<?php

namespace App\Filament\Resources\Servers\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ServerForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('hostname')
                    ->required(),
                TextInput::make('display_name'),
                TextInput::make('role'),
                TextInput::make('provider'),
                TextInput::make('environment'),
                TextInput::make('location_name'),
                TextInput::make('virtualization_type'),
                TextInput::make('os')
                    ->required(),
                TextInput::make('public_ip'),
                TextInput::make('cpu_usage')
                    ->required(),
                TextInput::make('ram_usage')
                    ->required(),
                TextInput::make('uptime')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('online'),
                Textarea::make('notes')
                    ->columnSpanFull(),
                Toggle::make('is_featured')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
