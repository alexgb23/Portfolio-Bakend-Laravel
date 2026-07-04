<?php

namespace App\Filament\Resources\Metrics\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class MetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('room')
                    ->required(),
                TextInput::make('parameter')
                    ->required(),
                TextInput::make('display_name'),
                TextInput::make('category'),
                TextInput::make('source_system'),
                TextInput::make('value')
                    ->required()
                    ->numeric(),
                TextInput::make('unit')
                    ->required(),
                TextInput::make('status')
                    ->required()
                    ->default('normal'),
                DateTimePicker::make('recorded_at'),
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
