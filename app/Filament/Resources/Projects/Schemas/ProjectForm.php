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
    // Normaliza cualquier valor a array limpio para TagsInput.
    protected static function normalizeArrayState(mixed $state): array
    {
        if (is_array($state)) {
            return array_values(array_filter($state, fn($item) => filled($item)));
        }

        if (blank($state)) {
            return [];
        }

        if (is_string($state)) {
            $decoded = json_decode($state, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter($decoded, fn($item) => filled($item)));
            }

            return array_values(array_filter(
                array_map('trim', explode(',', $state)),
                fn($item) => filled($item)
            ));
        }

        return [];
    }

    // Normaliza metadata a objeto asociativo válido.
    protected static function normalizeMetadataState(mixed $state): array
    {
        if (is_array($state)) {
            return self::isAssoc($state) ? $state : [];
        }

        if (blank($state)) {
            return [];
        }

        if (is_string($state)) {
            $decoded = json_decode($state, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return self::isAssoc($decoded) ? $decoded : [];
            }
        }

        return [];
    }

    protected static function isAssoc(array $array): bool
    {
        if ($array === []) {
            return true;
        }

        return array_keys($array) !== range(0, count($array) - 1);
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Section::make('Información principal')
                    ->schema([
                        TextInput::make('laboratorio_real_id')
                            ->label('Laboratorio real ID')
                            ->numeric(),

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
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state)),

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

                        Textarea::make('notas_tecnicas')
                            ->label('Notas técnicas')
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
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state)),

                        TextInput::make('stack_summary')
                            ->label('Resumen stack')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Imágenes y documentación')
                    ->schema([
                        // Campo principal de imagen. Cada valor queda visible como tag editable.
                        TagsInput::make('image_url')
                            ->label('Image URL')
                            ->placeholder('Añade una ruta o URL y pulsa Enter')
                            ->helperText('Ejemplo válido: /backendDarkAvif.avif')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state))
                            ->columnSpanFull(),

                        TagsInput::make('galeria_urls')
                            ->label('Galería URLs')
                            ->placeholder('Añade una ruta o URL y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state))
                            ->columnSpanFull(),

                        TagsInput::make('documentacion_urls')
                            ->label('Documentación URLs')
                            ->placeholder('Añade una ruta o URL y pulsa Enter')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state))
                            ->columnSpanFull(),
                    ]),

                Section::make('Enlaces')
                    ->schema([
                        TextInput::make('project_url')
                            ->label('Proyecto URL')
                            ->maxLength(255),

                        TextInput::make('frontend_url')
                            ->label('Frontend URL')
                            ->maxLength(255),

                        TextInput::make('backend_url')
                            ->label('Backend URL')
                            ->maxLength(255),

                        TextInput::make('api_base_url')
                            ->label('API base URL')
                            ->maxLength(255),

                        TextInput::make('staging_url')
                            ->label('Staging URL')
                            ->maxLength(255),

                        TextInput::make('repo_url')
                            ->label('Repositorio URL')
                            ->maxLength(255),

                        TextInput::make('referencia_externa')
                            ->label('Referencia externa')
                            ->maxLength(255),
                    ])
                    ->columns(2),

                Section::make('Estado y visibilidad')
                    ->schema([
                        Select::make('status')
                            ->label('Estado')
                            ->options([
                                'draft' => 'Draft',
                                'published' => 'Published',
                                'archived' => 'Archived',
                            ])
                            ->required()
                            ->native(false),

                        TextInput::make('sort_order')
                            ->label('Orden')
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
                        Textarea::make('metadata')
                            ->label('Metadata (JSON)')
                            ->rows(6)
                            ->formatStateUsing(function ($state): string {
                                $normalized = self::normalizeMetadataState($state);

                                return $normalized === []
                                    ? ''
                                    : json_encode($normalized, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
                            })
                            ->dehydrateStateUsing(function ($state): array {
                                if (blank($state)) {
                                    return [];
                                }

                                if (is_array($state)) {
                                    return self::normalizeMetadataState($state);
                                }

                                $decoded = json_decode($state, true);

                                return (json_last_error() === JSON_ERROR_NONE && is_array($decoded))
                                    ? self::normalizeMetadataState($decoded)
                                    : [];
                            })
                            ->helperText('Introduce un objeto JSON válido, por ejemplo: {"cliente":"ACME","prioridad":"alta"}')
                            ->columnSpanFull(),
                    ]),
            ]);
    }
}
