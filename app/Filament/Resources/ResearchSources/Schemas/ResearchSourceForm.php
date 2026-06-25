<?php

namespace App\Filament\Resources\ResearchSources\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ResearchSourceForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('source_type'),
                TextInput::make('author_name'),
                TextInput::make('publisher_name'),
                DatePicker::make('published_on'),
                TextInput::make('url')
                    ->url(),
                TextInput::make('reference_code'),
                Textarea::make('summary')
                    ->columnSpanFull(),
                Textarea::make('notes')
                    ->columnSpanFull(),
                TextInput::make('topic'),
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
