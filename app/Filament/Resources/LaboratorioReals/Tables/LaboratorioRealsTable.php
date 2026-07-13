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
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('slug')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('tipo_proyecto')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('area_principal')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('estado')
                    ->searchable()
                    ->sortable(),

                IconColumn::make('es_destacado')
                    ->boolean(),

                IconColumn::make('es_visible')
                    ->boolean(),

                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('adjuntos_count')
                    ->label('Adjuntos')
                    ->counts('adjuntos')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('documentacion_count')
                    ->label('Documentación')
                    ->counts('documentacion')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('avances_count')
                    ->label('Avances')
                    ->counts('avances')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('ideas_count')
                    ->label('Ideas')
                    ->counts('ideas')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('origen')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('referencia_externa')
                    ->searchable()
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('fecha_inicio')
                    ->date()
                    ->sortable()
                    ->toggleable(),

                TextColumn::make('fecha_fin')
                    ->date()
                    ->sortable()
                    ->toggleable(),

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
