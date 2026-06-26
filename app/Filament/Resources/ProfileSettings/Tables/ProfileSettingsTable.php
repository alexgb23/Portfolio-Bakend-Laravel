<?php

namespace App\Filament\Resources\ProfileSettings\Tables;

use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ProfileSettingsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('full_name')
                    ->label('Nombre completo')
                    ->searchable()
                    ->sortable()
                    ->weight('bold'),

                TextColumn::make('display_name')
                    ->label('Nombre visible')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('headline')
                    ->label('Headline')
                    ->searchable()
                    ->limit(50),

                TextColumn::make('subheadline')
                    ->label('Subheadline')
                    ->searchable()
                    ->limit(50)
                    ->toggleable(),

                TextColumn::make('location')
                    ->label('Ubicación')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('email_public')
                    ->label('Email')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('website_url')
                    ->label('Web')
                    ->limit(35)
                    ->url(fn ($record) => $record->website_url, shouldOpenInNewTab: true)
                    ->toggleable(),

                TextColumn::make('resume_url')
                    ->label('CV')
                    ->limit(35)
                    ->url(fn ($record) => $record->resume_url, shouldOpenInNewTab: true)
                    ->toggleable(isToggledHiddenByDefault: true),

                TextColumn::make('status_label')
                    ->label('Estado')
                    ->badge()
                    ->toggleable(),

                IconColumn::make('is_active')
                    ->label('Activo')
                    ->boolean()
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
            ])
            ->toolbarActions([]);
    }
}
