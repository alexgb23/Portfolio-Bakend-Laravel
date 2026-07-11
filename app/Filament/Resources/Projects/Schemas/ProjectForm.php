<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\KeyValue;
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

                        Textarea::make('notas_tecnicas')
                            ->label('Notas técnicas')
                            ->rows(6)
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

                        TextInput::make('stack_summary')
                            ->label('Resumen corto del stack')
                            ->placeholder('Ejemplo: Laravel + Docker + Filament + PostgreSQL + Render')
                            ->helperText('Campo opcional. Si no lo quieres, déjalo vacío.')
                            ->maxLength(255)
                            ->nullable(),
                    ])
                    ->columns(2),

                Section::make('Galería y documentación')
                    ->schema([
                        TagsInput::make('image_url')
                            ->label('Imágenes principales')
                            ->placeholder('Pega una URL y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab'])
                            ->trim()
                            ->helperText('Si hay imágenes, las verás aquí como etiquetas y podrás borrarlas con la x.'),

                        TagsInput::make('galeria_urls')
                            ->label('Galería adicional')
                            ->placeholder('Pega una URL y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab'])
                            ->trim()
                            ->helperText('Opcional. Si no hay URLs, déjalo vacío.'),

                        TagsInput::make('documentacion_urls')
                            ->label('URLs de documentación')
                            ->placeholder('Pega una URL y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab'])
                            ->trim()
                            ->helperText('Si hay URLs, las verás aquí y podrás borrarlas con la x. Si no hay, déjalo vacío.'),
                    ])
                    ->columns(1),

                Section::make('Enlaces')
                    ->schema([
                        TextInput::make('project_url')
                            ->label('URL del proyecto')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('frontend_url')
                            ->label('URL frontend')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('backend_url')
                            ->label('URL backend')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('api_base_url')
                            ->label('API base URL')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('staging_url')
                            ->label('URL de pruebas')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('repo_url')
                            ->label('URL del repositorio')
                            ->url()
                            ->nullable()
                            ->maxLength(2048),

                        TextInput::make('referencia_externa')
                            ->label('Referencia externa')
                            ->helperText('Opcional. Puede ser una URL, una nota corta o una referencia libre.')
                            ->maxLength(2048),
                    ])
                    ->columns(2),

                Section::make('Publicación')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->required()
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->default('published')
                            ->native(false),

                        TextInput::make('sort_order')
                            ->label('Orden')
                            ->required()
                            ->numeric()
                            ->default(0),

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

                Section::make('Metadata')
                    ->schema([
                        KeyValue::make('metadata')
                            ->label('Metadata')
                            ->keyLabel('Clave')
                            ->valueLabel('Valor')
                            ->addActionLabel('Añadir metadata')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
