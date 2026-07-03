<?php

namespace App\Filament\Resources\LaboratorioReals\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class LaboratorioRealForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->required(),
                TextInput::make('slug')
                    ->required(),
                TextInput::make('tipo_proyecto'),
                TextInput::make('area_principal'),
                TextInput::make('areas_relacionadas'),
                TextInput::make('estado')
                    ->required()
                    ->default('borrador'),
                Toggle::make('es_destacado')
                    ->required(),
                Toggle::make('es_visible')
                    ->required(),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                Textarea::make('notas_tecnicas')
                    ->columnSpanFull(),
                Textarea::make('objetivo')
                    ->columnSpanFull(),
                Textarea::make('resultado_actual')
                    ->columnSpanFull(),
                TextInput::make('galeria_urls'),
                TextInput::make('documentacion_urls'),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                TextInput::make('referencia_externa'),
                TextInput::make('metadata'),
                DatePicker::make('fecha_inicio'),
                DatePicker::make('fecha_fin'),
            ]);
    }
}
