<?php

namespace App\Filament\Resources\ProfileHighlights\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProfileHighlightForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('number')
                    ->label('Número')
                    ->required()
                    ->maxLength(10),

                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Textarea::make('text')
                    ->label('Texto')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                Select::make('side')
                    ->label('Lado')
                    ->options([
                        'left' => 'Left',
                        'right' => 'Right',
                    ])
                    ->required()
                    ->default('left')
                    ->native(false),

                TextInput::make('sort_order')
                    ->label('Orden')
                    ->numeric()
                    ->required()
                    ->default(0)
                    ->minValue(0),

                Toggle::make('is_visible')
                    ->label('Visible')
                    ->default(true)
                    ->required(),
            ]);
    }
}
