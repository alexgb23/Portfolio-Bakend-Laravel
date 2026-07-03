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
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class DocumentacionRelationManager extends RelationManager
{
    protected static string $relationship = 'documentacion';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('fase'),
                TextInput::make('seccion'),
                TextInput::make('tipo_documentacion'),
                TextInput::make('titulo')
                    ->required(),
                Textarea::make('resumen')
                    ->columnSpanFull(),
                Textarea::make('contenido')
                    ->columnSpanFull(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('orden')
                    ->required()
                    ->numeric()
                    ->default(0),
                TextInput::make('estado')
                    ->required()
                    ->default('borrador'),
                Toggle::make('es_visible')
                    ->required(),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                TextInput::make('metadata'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->columns([
                TextColumn::make('fase')
                    ->searchable(),
                TextColumn::make('seccion')
                    ->searchable(),
                TextColumn::make('tipo_documentacion')
                    ->searchable(),
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('orden')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('estado')
                    ->searchable(),
                IconColumn::make('es_visible')
                    ->boolean(),
                TextColumn::make('origen')
                    ->searchable(),
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
