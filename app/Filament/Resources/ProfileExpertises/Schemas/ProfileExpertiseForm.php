<?php

namespace App\Filament\Resources\ProfileExpertises\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProfileExpertiseForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Textarea::make('text')
                    ->label('Texto')
                    ->required()
                    ->rows(4)
                    ->columnSpanFull(),

                TextInput::make('icon_key')
                    ->label('Icon key')
                    ->maxLength(255),

                Select::make('tone')
                    ->label('Tono')
                    ->options([
                        'tone-0' => 'Tone 0',
                        'tone-1' => 'Tone 1',
                        'tone-2' => 'Tone 2',
                        'tone-3' => 'Tone 3',
                        'tone-4' => 'Tone 4',
                        'tone-5' => 'Tone 5',
                    ])
                    ->required()
                    ->default('tone-0')
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
