<?php

namespace App\Filament\Resources\LocalAiSetups\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LocalAiSetupForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('provider'),
                TextInput::make('model_name'),
                TextInput::make('model_size'),
                TextInput::make('base_url')
                    ->url(),
                TextInput::make('interface_name'),
                Textarea::make('description')
                    ->columnSpanFull(),
                Textarea::make('hardware_notes')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('active'),
                Toggle::make('is_featured')
                    ->required(),
                Toggle::make('is_visible')
                    ->required(),
                TextInput::make('sort_order')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
