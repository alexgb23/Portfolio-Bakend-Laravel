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
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class IdeasRelationManager extends RelationManager
{
    protected static string $relationship = 'ideas';

    protected static ?string $title = 'Ideas';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

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

                TagsInput::make('urls_relacionadas'),

                Textarea::make('metadata')
                    ->columnSpanFull(),
            ]);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->columns([
                TextColumn::make('id')
                    ->label('ID')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fase')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('seccion')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('estado')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('prioridad')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('origen')
                    ->searchable()
                    ->toggleable(),

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
