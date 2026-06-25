<?php

namespace App\Filament\Resources\AiStudyCases\Schemas;

use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class AiStudyCaseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('category'),
                TextInput::make('technology_stack'),
                Textarea::make('context')
                    ->columnSpanFull(),
                Textarea::make('challenge')
                    ->columnSpanFull(),
                Textarea::make('solution')
                    ->columnSpanFull(),
                Textarea::make('results')
                    ->columnSpanFull(),
                TextInput::make('status')
                    ->required()
                    ->default('published'),
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
