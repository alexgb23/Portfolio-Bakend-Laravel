<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
    // Convierte arrays o JSON en una lista limpia de strings.
    protected static function normalizeArrayish(mixed $state): array
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

    // Devuelve arrays en varias líneas para que se lean mejor en tabla.
    protected static function multilineArrayish(mixed $state): string
    {
        $items = self::normalizeArrayish($state);

        if ($items === []) {
            return '—';
        }

        return implode(PHP_EOL, $items);
    }

    // Devuelve un JSON bonito y legible si existe.
    protected static function stringifyJson(mixed $state): string
    {
        if (is_array($state)) {
            return json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        }

        if (blank($state)) {
            return '';
        }

        if (is_string($state)) {
            $decoded = json_decode($state, true);

            if (json_last_error() === JSON_ERROR_NONE) {
                return json_encode($decoded, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
            }

            return $state;
        }

        return '';
    }

    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('title')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->sortable(),

                TextColumn::make('laboratorio_real_id')
                    ->label('Laboratorio real ID')
                    ->sortable()
                    ->searchable(),

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo_proyecto')
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('area_principal')
                    ->label('Área principal')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('areas_relacionadas')
                    ->label('Áreas relacionadas')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->lineClamp(3)
                    ->wrap(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('short_description')
                    ->label('Descripción corta')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('resumen')
                    ->label('Resumen')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('notas_tecnicas')
                    ->label('Notas técnicas')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('objetivo')
                    ->label('Objetivo')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('resultado_actual')
                    ->label('Resultado actual')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('technologies')
                    ->label('Tecnologías')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->lineClamp(4)
                    ->wrap(),

                TextColumn::make('stack_summary')
                    ->label('Resumen stack')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                // Muestra cada imagen en una línea para ver qué hay dentro del array.
                TextColumn::make('image_url')
                    ->label('Image URL')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->listWithLineBreaks()
                    ->limitList(3)
                    ->expandableLimitedList()
                    ->copyable()
                    ->wrap(),

                // Igual para la galería.
                TextColumn::make('galeria_urls')
                    ->label('Galería URLs')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->listWithLineBreaks()
                    ->limitList(4)
                    ->expandableLimitedList()
                    ->copyable()
                    ->wrap(),

                // Igual para documentación.
                TextColumn::make('documentacion_urls')
                    ->label('Documentación URLs')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->listWithLineBreaks()
                    ->limitList(4)
                    ->expandableLimitedList()
                    ->copyable()
                    ->wrap(),

                TextColumn::make('project_url')
                    ->label('Proyecto URL')
                    ->wrap(),

                TextColumn::make('frontend_url')
                    ->label('Frontend URL')
                    ->wrap(),

                TextColumn::make('backend_url')
                    ->label('Backend URL')
                    ->wrap(),

                TextColumn::make('api_base_url')
                    ->label('API base URL')
                    ->wrap(),

                TextColumn::make('staging_url')
                    ->label('Staging URL')
                    ->wrap(),

                TextColumn::make('repo_url')
                    ->label('Repositorio URL')
                    ->wrap(),

                TextColumn::make('referencia_externa')
                    ->label('Referencia externa')
                    ->wrap(),

                TextColumn::make('metadata')
                    ->label('Metadata')
                    ->formatStateUsing(fn($state): string => self::stringifyJson($state))
                    ->wrap(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_published')
                    ->label('Publicado')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->sortable(),

                TextColumn::make('fecha_inicio')
                    ->label('Fecha inicio')
                    ->date()
                    ->sortable(),

                TextColumn::make('fecha_fin')
                    ->label('Fecha fin')
                    ->date()
                    ->sortable(),

                TextColumn::make('created_at')
                    ->label('Creado')
                    ->dateTime()
                    ->sortable(),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
