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

class IdeasRelationManager extends RelationManager
{
    protected static string $relationship = 'ideas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo'),
                Textarea::make('idea')
                    ->required()
                    ->columnSpanFull(),
                Textarea::make('detalle')
                    ->columnSpanFull(),
                TextInput::make('fase'),
                TextInput::make('seccion'),
                TextInput::make('estado')
                    ->required()
                    ->default('nueva'),
                TextInput::make('prioridad')
                    ->required()
                    ->default('media'),
                TextInput::make('origen')
                    ->required()
                    ->default('manual'),
                Toggle::make('creada_por_ia')
                    ->required(),
                TextInput::make('urls_relacionadas'),
                TextInput::make('metadata'),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->columns([
                TextColumn::make('titulo')
                    ->searchable(),
                TextColumn::make('fase')
                    ->searchable(),
                TextColumn::make('seccion')
                    ->searchable(),
                TextColumn::make('estado')
                    ->searchable(),
                TextColumn::make('prioridad')
                    ->searchable(),
                TextColumn::make('origen')
                    ->searchable(),
                IconColumn::make('creada_por_ia')
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
