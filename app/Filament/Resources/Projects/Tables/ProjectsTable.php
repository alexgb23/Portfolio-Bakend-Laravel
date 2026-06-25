<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkActionGroup;
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
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('short_description')
                    ->label('Descripción corta')
                    ->limit(40)
                    ->searchable(),
                    

                TextColumn::make('technologies')
                    ->label('Tecnologías')
                    ->badge()
                    ->separator(',')
                    ->toggleable(),

                TextColumn::make('status')
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
                    ->url(fn($record) => $record->project_url, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('repo_url')
                    ->label('Repositorio')
                    ->limit(30)
                    ->url(fn($record) => $record->repo_url, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
