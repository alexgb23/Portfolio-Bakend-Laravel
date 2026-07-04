<?php

namespace App\Filament\Resources\Skills\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class SkillsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('name')
                    ->label('Nombre')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('slug')
                    ->label('Slug')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('category')
                    ->label('Categoría')
                    ->badge()
                    ->sortable()
                    ->searchable(),

                TextColumn::make('proficiency_level')
                    ->label('Nivel')
                    ->badge()
                    ->sortable()
                    ->color(fn (?string $state): string => match ($state) {
                        'beginner' => 'gray',
                        'intermediate' => 'info',
                        'advanced' => 'success',
                        'expert' => 'warning',
                        default => 'gray',
                    }),

                TextColumn::make('proficiency_score')
                    ->label('Puntuación')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('icon_name')
                    ->label('Icono')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('description')
                    ->label('Descripción')
                    ->limit(50)
                    ->toggleable(),

                IconColumn::make('is_featured')
                    ->label('Destacado')
                    ->boolean()
                    ->sortable(),

                IconColumn::make('is_visible')
                    ->label('Visible')
                    ->boolean()
                    ->sortable(),

                TextColumn::make('sort_order')
                    ->label('Orden')
                    ->numeric()
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
