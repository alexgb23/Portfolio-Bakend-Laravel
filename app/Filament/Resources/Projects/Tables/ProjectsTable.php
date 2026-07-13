<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProjectsTable
{
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

    protected static function multilineArrayish(mixed $state): string
    {
        $items = self::normalizeArrayish($state);

        if ($items === []) {
            return '—';
        }

        return implode(PHP_EOL, $items);
    }

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

                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('laboratorioReal.titulo')
                    ->label('Laboratorio')
                    ->searchable()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('laboratorio_real_id')
                    ->label('Laboratorio ID')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('area_principal')
                    ->label('Área principal')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('stack_summary')
                    ->label('Resumen stack')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('adjuntos_count')
                    ->label('Adjuntos')
                    ->counts('adjuntos')
                    ->sortable(),

                TextColumn::make('documentacion_count')
                    ->label('Documentación')
                    ->counts('documentacion')
                    ->sortable(),

                TextColumn::make('secciones_count')
                    ->label('Secciones')
                    ->counts('secciones')
                    ->sortable(),

                TextColumn::make('technologies')
                    ->label('Tecnologías')
                    ->formatStateUsing(fn($state): string => self::multilineArrayish($state))
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('short_description')
                    ->label('Descripción corta')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('resumen')
                    ->label('Resumen')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('notas_tecnicas')
                    ->label('Notas técnicas')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('objetivo')
                    ->label('Objetivo')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('resultado_actual')
                    ->label('Resultado actual')
                    ->limit(80)
                    ->wrap()
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('metadata')
                    ->label('Metadata')
                    ->formatStateUsing(fn($state): string => self::stringifyJson($state))
                    ->wrap()
                    ->toggleable(isToggledHiddenByDefault: true),

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
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
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
