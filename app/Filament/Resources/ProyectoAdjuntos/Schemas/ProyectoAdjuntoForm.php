<?php

namespace App\Filament\Resources\ProyectoAdjuntos\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class ProyectoAdjuntoForm
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
                TextInput::make('tipo')
                    ->required()
                    ->default('enlace'),
                TextInput::make('grupo'),
                TextInput::make('subtitulo'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                TextInput::make('origen'),
                TextInput::make('nombre_archivo'),
                TextInput::make('mime_type'),
                TextInput::make('url')
                    ->url(),
                TextInput::make('icono'),
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
