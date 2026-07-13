<?php

namespace App\Filament\Resources\AdjuntoLaboratorios\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AdjuntoLaboratorioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('laboratorio_real_id')
                    ->relationship('laboratorioReal', 'id')
                    ->required(),
                TextInput::make('seccion'),
                TextInput::make('fase'),
                TextInput::make('tipo_adjunto'),
                TextInput::make('storage_driver'),
                Textarea::make('url')
                    ->columnSpanFull(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('nombre_archivo'),
                TextInput::make('mime_type'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                Textarea::make('resumen_ia')
                    ->columnSpanFull(),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                TextInput::make('metadata'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }
}
