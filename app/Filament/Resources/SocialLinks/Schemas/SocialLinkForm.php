<?php

namespace App\Filament\Resources\SocialLinks\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class SocialLinkForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
                    ->schema([
                        Select::make('platform')
                            ->label('Plataforma')
                            ->required()
                            ->options([
                                'github' => 'GitHub',
                                'linkedin' => 'LinkedIn',
                                'email' => 'Email',
                                'web' => 'Web',
                                'instagram' => 'Instagram',
                                'facebook' => 'Facebook',
                                'x' => 'X / Twitter',
                                'youtube' => 'YouTube',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('icon_key')
                            ->label('Clave de icono')
                            ->maxLength(255),

                        TextInput::make('label')
                            ->label('Etiqueta')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('title')
                            ->label('Título')
                            ->maxLength(255),

                        TextInput::make('text')
                            ->label('Texto')
                            ->maxLength(255),

                        TextInput::make('url')
                            ->label('URL')
                            ->url()
                            ->maxLength(2048),
                    ])
                    ->columns(2),

                Section::make('Publicación')
                    ->schema([
                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),

                        Toggle::make('is_visible')
                            ->label('Visible')
                            ->default(true),
                    ])
                    ->columns(2),
            ]);
    }
}
