<?php

namespace App\Filament\Resources\Servers\Tables;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ServersTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('hostname')
                    ->searchable(),
                TextColumn::make('display_name')
                    ->searchable(),
                TextColumn::make('role')
                    ->searchable(),
                TextColumn::make('provider')
                    ->searchable(),
                TextColumn::make('environment')
                    ->searchable(),
                TextColumn::make('location_name')
                    ->searchable(),
                TextColumn::make('virtualization_type')
                    ->searchable(),
                TextColumn::make('os')
                    ->searchable(),
                TextColumn::make('public_ip')
                    ->searchable(),
                TextColumn::make('cpu_usage')
                    ->searchable(),
                TextColumn::make('ram_usage')
                    ->searchable(),
                TextColumn::make('uptime')
                    ->searchable(),
                TextColumn::make('status')
                    ->searchable(),
                IconColumn::make('is_featured')
                    ->boolean(),
                TextColumn::make('sort_order')
                    ->numeric()
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
