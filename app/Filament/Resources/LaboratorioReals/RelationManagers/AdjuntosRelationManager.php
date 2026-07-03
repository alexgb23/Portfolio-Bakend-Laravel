<?php

namespace App\Filament\Resources\LaboratorioReals\RelationManagers;

use Filament\Actions\AssociateAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\DissociateAction;
use Filament\Actions\DissociateBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdjuntosRelationManager extends RelationManager
{
    protected static string $relationship = 'adjuntos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('seccion'),
                TextInput::make('fase'),
                TextInput::make('tipo_adjunto'),
                TextInput::make('storage_driver'),
                Textarea::make('url')
                    ->columnSpanFull(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('nombre_archivo'),
                TextInput::make('mime_type'),
                Textarea::make('descripcion')
                    ->columnSpanFull(),
                Textarea::make('resumen_ia')
                    ->columnSpanFull(),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                TextInput::make('metadata'),
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
                TextColumn::make('seccion')
                    ->searchable(),
                TextColumn::make('fase')
                    ->searchable(),
                TextColumn::make('tipo_adjunto')
                    ->searchable(),
                TextColumn::make('storage_driver')
                    ->searchable(),
                TextColumn::make('nombre_archivo')
                    ->searchable(),
                TextColumn::make('mime_type')
                    ->searchable(),
                TextColumn::make('origen')
                    ->searchable(),
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
                AssociateAction::make(),
            ])
            ->recordActions([
                EditAction::make(),
                DissociateAction::make(),
                DeleteAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DissociateBulkAction::make(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }
}
