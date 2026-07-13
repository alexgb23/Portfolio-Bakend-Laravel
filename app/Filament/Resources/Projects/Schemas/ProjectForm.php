<?php

namespace App\Filament\Resources\Projects\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
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
            return array_values(array_filter(
                array_map(fn($item) => is_scalar($item) ? trim((string) $item) : '', $state),
                fn($item) => filled($item)
            ));
        }

        if (blank($state)) {
            return [];
        }

        if (is_string($state)) {
            $decoded = json_decode($state, true);

            if (json_last_error() === JSON_ERROR_NONE && is_array($decoded)) {
                return array_values(array_filter(
                    array_map(fn($item) => is_scalar($item) ? trim((string) $item) : '', $decoded),
                    fn($item) => filled($item)
                ));
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

                        TextInput::make('area_principal')
                            ->label('Área principal')
                            ->maxLength(255),

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
                            ->helperText('Puedes añadir, editar, reordenar o eliminar tecnologías directamente aquí.')
                            ->splitKeys(['Enter', 'Tab', ','])
                            ->reorderable()
                            ->afterStateHydrated(fn($component, $state) => $component->state(self::normalizeArrayState($state)))
                            ->dehydrateStateUsing(fn($state) => self::normalizeArrayState($state))
                            ->columnSpanFull(),

                        TextInput::make('stack_summary')
                            ->label('Resumen stack')
                            ->maxLength(255)
                            ->columnSpanFull(),
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
