<?php

namespace App\Filament\Resources\LaboratorioReals\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class LaboratorioRealsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('slug')
                    ->searchable(),
                TextColumn::make('tipo_proyecto')
                    ->searchable(),
                TextColumn::make('area_principal')
                    ->searchable(),
                TextColumn::make('estado')
                    ->searchable(),
                IconColumn::make('es_destacado')
                    ->boolean(),
                IconColumn::make('es_visible')
                    ->boolean(),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('origen')
                    ->searchable(),
                TextColumn::make('referencia_externa')
                    ->searchable(),
                TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable(),
                TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable(),
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
