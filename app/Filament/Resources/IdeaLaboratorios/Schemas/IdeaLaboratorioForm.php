<?php

namespace App\Filament\Resources\IdeaLaboratorios\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class IdeaLaboratorioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('laboratorio_real_id')
                    ->relationship('laboratorioReal', 'id')
                    ->required(),
                TextInput::make('titulo'),
                Textarea::make('idea')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('detalle')
                    ->columnSpanFull(),
                TextInput::make('fase'),
                TextInput::make('seccion'),
                TextInput::make('estado')
                    ->required()
                    ->default('nueva'),
                TextInput::make('prioridad')
                    ->required()
                    ->default('media'),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                Toggle::make('creada_por_ia')
                    ->required(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('metadata'),
            ]);
    }
}
