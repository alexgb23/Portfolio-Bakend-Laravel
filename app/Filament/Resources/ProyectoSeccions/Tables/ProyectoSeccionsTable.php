<?php

namespace App\Filament\Resources\ProyectoSeccions\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProyectoSeccionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('project.title')
                    ->searchable(),
                TextColumn::make('clave')
                    ->searchable(),
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('tipo_contenido')
                    ->searchable(),
                TextColumn::make('layout')
                    ->searchable(),
                TextColumn::make('media_url')
                    ->searchable(),
                TextColumn::make('codigo_lenguaje')
                    ->searchable(),
                TextColumn::make('origen')
                    ->searchable(),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
                IconColumn::make('es_visible')
                    ->boolean(),
                IconColumn::make('es_destacado')
                    ->boolean(),
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
