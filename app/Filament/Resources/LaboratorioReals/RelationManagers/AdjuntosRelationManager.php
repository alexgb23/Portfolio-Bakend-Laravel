<?php

namespace App\Filament\Resources\LaboratorioReals\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdjuntosRelationManager extends RelationManager
{
    protected static string $relationship = 'adjuntos';

    protected static ?string $title = 'Adjuntos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

                TextInput::make('seccion'),

                TextInput::make('fase'),

                TextInput::make('tipo_adjunto'),

                TextInput::make('storage_driver'),

                Textarea::make('url')
                    ->columnSpanFull(),

                TagsInput::make('urls_relacionadas'),

                TextInput::make('nombre_archivo'),

                TextInput::make('mime_type'),

                Textarea::make('descripcion')
                    ->columnSpanFull(),

                Textarea::make('resumen_ia')
                    ->columnSpanFull(),

                TextInput::make('origen')
                    ->required()
                    ->default('manual'),

                Textarea::make('metadata')
                    ->columnSpanFull(),

                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('nombre_archivo')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('nombre_archivo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo_adjunto')
                    ->label('Tipo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('seccion')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('fase')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('storage_driver')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('mime_type')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('origen')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('orden')
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
            ->headerActions([
                CreateAction::make(),
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
