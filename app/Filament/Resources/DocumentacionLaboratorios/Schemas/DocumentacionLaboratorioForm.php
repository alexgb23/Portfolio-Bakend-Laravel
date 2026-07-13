<?php

namespace App\Filament\Resources\DocumentacionLaboratorios\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class DocumentacionLaboratorioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('laboratorio_real_id')
                    ->relationship('laboratorioReal', 'id')
                    ->required(),
                TextInput::make('fase'),
                TextInput::make('seccion'),
                TextInput::make('tipo_documentacion'),
                TextInput::make('titulo')
                    ->required(),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->columnSpanFull(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('estado')
                    ->required()
                    ->default('borrador'),
                Toggle::make('es_visible')
                    ->required(),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                TextInput::make('metadata'),
            ]);
    }
}
