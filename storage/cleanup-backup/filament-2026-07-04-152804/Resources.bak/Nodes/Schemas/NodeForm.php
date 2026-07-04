<?php

namespace App\Filament\Resources\Nodes\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class NodeForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('node_name')
                    ->required(),
                TextInput::make('location_name'),
                TextInput::make('type')
                    ->required(),
                TextInput::make('source_system'),
                TextInput::make('protocol'),
                TextInput::make('current_value')
                    ->required(),
                TextInput::make('unit'),
                TextInput::make('ip_address'),
                TextInput::make('status')
                    ->required(),
                DateTimePicker::make('last_seen_at'),
                Toggle::make('is_active')
                    ->required(),
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
