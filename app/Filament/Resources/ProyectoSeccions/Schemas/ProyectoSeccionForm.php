<?php

namespace App\Filament\Resources\ProyectoSeccions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProyectoSeccionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),
                TextInput::make('clave')
                    ->required(),
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('tipo_contenido')
                    ->required()
                    ->default('texto'),
                TextInput::make('layout'),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->columnSpanFull(),
                TextInput::make('items'),
                TextInput::make('media_url')
                    ->url(),
                TextInput::make('codigo_lenguaje'),
                TextInput::make('origen'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                Toggle::make('es_visible')
                    ->required(),
                Toggle::make('es_destacado')
                    ->required(),
                TextInput::make('metadata'),
            ]);
    }
}
