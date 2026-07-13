<?php

namespace App\Filament\Resources\ProyectoDocumentacions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProyectoDocumentacionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('project_id')
                    ->relationship('project', 'title')
                    ->required(),
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('slug'),
                TextInput::make('seccion'),
                TextInput::make('tipo')
                    ->required()
                    ->default('general'),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->columnSpanFull(),
                TextInput::make('origen'),
                TextInput::make('url_referencia'),
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
