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
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('title')
                    ->label('Título')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('tipo_proyecto')
                    ->label('Tipo')
                    ->badge()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('area_principal')
                    ->label('Área principal')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('short_description')
                    ->label('Descripción corta')
                    ->limit(60)
                    ->searchable()
                    ->wrap(),

                TextColumn::make('technologies_summary')
                    ->label('Tecnologías')
                    ->getStateUsing(fn($record) => implode(', ', $record->technologies_list))
                    ->placeholder('—')
                    ->wrap(false)
                    ->limit(90)
                    ->tooltip(fn($record): ?string => count($record->technologies_list) ? implode(', ', $record->technologies_list) : null)
                    ->toggleable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->sortable()
                    ->color(fn(string $state): string => match ($state) {
                        'draft' => 'gray',
                        'published' => 'success',
                        'archived' => 'danger',
                        default => 'warning',
                    }),

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

                TextColumn::make('project_url')
                    ->label('Proyecto')
                    ->limit(30)
                    ->url(fn($record) => filled($record->project_url) ? $record->project_url : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('repo_url')
                    ->label('Repositorio')
                    ->limit(30)
                    ->url(fn($record) => filled($record->repo_url) ? $record->repo_url : null, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),

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
