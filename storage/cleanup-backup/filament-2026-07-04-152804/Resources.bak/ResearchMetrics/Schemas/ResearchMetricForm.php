<?php

namespace App\Filament\Resources\ResearchMetrics\Schemas;

use App\Models\ResearchSource;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;

class ResearchMetricForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Fuente y métrica')
                    ->schema([
                        Select::make('research_source_id')
                            ->label('Fuente')
                            ->relationship('source', 'title')
                            ->searchable()
                            ->preload()
                            ->required(),

                        TextInput::make('metric_name')
                            ->label('Nombre de métrica')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('metric_value')
                            ->label('Valor')
                            ->required()
                            ->maxLength(255),

                        TextInput::make('metric_unit')
                            ->label('Unidad')
                            ->maxLength(255),

                        DatePicker::make('measured_on')
                            ->label('Fecha de medición'),
                    ])
                    ->columns(2),

                Section::make('Notas')
                    ->schema([
                        Textarea::make('notes')
                            ->label('Notas')
                            ->rows(5)
                            ->columnSpanFull(),
                    ]),

                Section::make('Estado')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'active' => 'Active',
                                'draft' => 'Draft',
                                'archived' => 'Archived',
                            ])
                            ->default('active')
                            ->native(false),

                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),

                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),
                    ])
                    ->columns(2),
            ]);
    }
}
