<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
                    ->schema([
                        TextInput::make('title')
                            ->label('Título')
                            ->required()
                            ->maxLength(255)
                            ->live(onBlur: true)
                            ->afterStateUpdated(fn(Set $set, ?string $state) => $set('slug', Str::slug($state))),

                        TextInput::make('slug')
                            ->label('Slug')
                            ->required()
                            ->maxLength(255)
                            ->unique(ignoreRecord: true),

                        Select::make('tipo_proyecto')
                            ->label('Tipo de proyecto')
                            ->options([
                                'web' => 'Web',
                                'mobile' => 'Mobile',
                                'api' => 'API',
                                'backend' => 'Backend',
                                'frontend' => 'Frontend',
                                'fullstack' => 'Full Stack',
                                'ia' => 'IA',
                                'data' => 'Data',
                                'tool' => 'Tool',
                                'other' => 'Other',
                            ])
                            ->searchable()
                            ->native(false),

                        TextInput::make('area_principal')
                            ->label('Área principal')
                            ->maxLength(255),

                        TagsInput::make('areas_relacionadas')
                            ->label('Áreas relacionadas')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->trim(),

                        Textarea::make('short_description')
                            ->label('Descripción corta')
                            ->rows(3)
                            ->maxLength(280)
                            ->columnSpanFull(),

                        Textarea::make('description')
                            ->label('Descripción')
                            ->required()
                            ->rows(6)
                            ->columnSpanFull(),
                    ])
                    ->columns(2),

                Section::make('Contenido ampliado')
                    ->schema([
                        Textarea::make('resumen')
                            ->label('Resumen')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('objetivo')
                            ->label('Objetivo')
                            ->rows(4)
                            ->columnSpanFull(),

                        Textarea::make('resultado_actual')
                            ->label('Resultado actual')
                            ->rows(4)
                            ->columnSpanFull(),
                    ]),

                Section::make('Tecnología')
                    ->schema([
                        TagsInput::make('technologies')
                            ->label('Tecnologías')
                            ->placeholder('Escribe una tecnología y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->trim()
                            ->reorderable()
                            ->helperText('Verás las tecnologías existentes como etiquetas. Pulsa la x para borrar una.'),
                    ]),


                Section::make('Visibilidad')
                    ->schema([
                        Toggle::make('is_featured')
                            ->label('Destacado')
                            ->default(false),

                        Toggle::make('is_published')
                            ->label('Publicado')
                            ->default(true),
                    ])
                    ->columns(2),

                Section::make('Fechas')
                    ->schema([
                        DatePicker::make('fecha_inicio')
                            ->label('Fecha de inicio'),

                        DatePicker::make('fecha_fin')
                            ->label('Fecha de fin'),
                    ])
                    ->columns(2),
            ]);
    }
}
