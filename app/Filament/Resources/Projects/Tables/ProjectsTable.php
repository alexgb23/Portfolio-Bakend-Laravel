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
                    ->numeric()
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
                    ->formatStateUsing(fn($state): string => is_array($state) ? implode(', ', array_filter($state)) : '')
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
                    ->formatStateUsing(fn($state): string => is_array($state) ? implode(', ', array_filter($state)) : '')
                    ->wrap(),

                TextColumn::make('stack_summary')
                    ->label('Resumen stack')
                    ->limit(80)
                    ->wrap()
                    ->searchable(),

                TextColumn::make('image_url')
                    ->label('Image URL')
                    ->formatStateUsing(fn($state): string => is_array($state) ? implode("\n", array_filter($state)) : '')
                    ->wrap(),

                TextColumn::make('galeria_urls')
                    ->label('Galería URLs')
                    ->formatStateUsing(fn($state): string => is_array($state) ? implode("\n", array_filter($state)) : '')
                    ->wrap(),

                TextColumn::make('documentacion_urls')
                    ->label('Documentación URLs')
                    ->formatStateUsing(fn($state): string => is_array($state) ? implode("\n", array_filter($state)) : '')
                    ->wrap(),

                TextColumn::make('project_url')
                    ->label('Proyecto URL')
                    ->url(fn($record) => filled($record->project_url) ? $record->project_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('frontend_url')
                    ->label('Frontend URL')
                    ->url(fn($record) => filled($record->frontend_url) ? $record->frontend_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('backend_url')
                    ->label('Backend URL')
                    ->url(fn($record) => filled($record->backend_url) ? $record->backend_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('api_base_url')
                    ->label('API base URL')
                    ->url(fn($record) => filled($record->api_base_url) ? $record->api_base_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('staging_url')
                    ->label('Staging URL')
                    ->url(fn($record) => filled($record->staging_url) ? $record->staging_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('repo_url')
                    ->label('Repositorio URL')
                    ->url(fn($record) => filled($record->repo_url) ? $record->repo_url : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('referencia_externa')
                    ->label('Referencia externa')
                    ->url(fn($record) => filled($record->referencia_externa) ? $record->referencia_externa : null, shouldOpenInNewTab: true)
                    ->wrap(),

                TextColumn::make('metadata')
                    ->label('Metadata')
                    ->formatStateUsing(fn($state): string => is_array($state) ? json_encode($state, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) : '')
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
                    ->numeric()
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
