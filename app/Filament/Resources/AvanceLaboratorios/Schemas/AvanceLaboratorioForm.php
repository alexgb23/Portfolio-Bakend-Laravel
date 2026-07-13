<?php

namespace App\Filament\Resources\AvanceLaboratorios\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Schemas\Schema;

class AvanceLaboratorioForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('laboratorio_real_id')
                    ->relationship('laboratorioReal', 'id')
                    ->required(),
                TextInput::make('titulo')
                    ->required(),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                TextInput::make('fase'),
                TextInput::make('seccion'),
                TextInput::make('tipo_avance'),
                TextInput::make('estado')
                    ->required()
                    ->default('registrado'),
                DateTimePicker::make('fecha_avance'),
                TextInput::make('urls_relacionadas'),
                TextInput::make('metadata'),
            ]);
    }
}
