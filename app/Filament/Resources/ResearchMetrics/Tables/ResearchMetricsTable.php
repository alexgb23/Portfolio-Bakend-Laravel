<?php

namespace App\Filament\Resources\ResearchMetrics\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ResearchMetricsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('sort_order')
            ->columns([
                TextColumn::make('source.title')
                    ->label('Fuente')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('metric_name')
                    ->label('Métrica')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('metric_value')
                    ->label('Valor')
                    ->searchable(),

                TextColumn::make('metric_unit')
                    ->label('Unidad')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('measured_on')
                    ->label('Medido el')
                    ->date()
                    ->sortable(),

                TextColumn::make('status')
                    ->label('Estado')
                    ->badge()
                    ->sortable()
                    ->color(fn (string $state): string => match ($state) {
                        'active' => 'success',
                        'draft' => 'warning',
                        'archived' => 'danger',
                        default => 'gray',
                    }),

                IconColumn::make('is_featured')
                    ->label('Destacado')
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
