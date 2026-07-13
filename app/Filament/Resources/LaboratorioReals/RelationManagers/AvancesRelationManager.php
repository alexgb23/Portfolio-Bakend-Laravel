<?php

namespace App\Filament\Resources\LaboratorioReals\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\TagsInput;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AvancesRelationManager extends RelationManager
{
    protected static string $relationship = 'avances';

    protected static ?string $title = 'Avances';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('id')
                    ->label('ID')
                    ->disabled()
                    ->dehydrated(false)
                    ->visible(fn($record) => $record !== null),

                TextInput::make('titulo')
                    ->required(),

                Textarea::make('resumen')
                    ->columnSpanFull(),

                Textarea::make('descripcion')
                    ->columnSpanFull(),

                TextInput::make('fase'),

                TextInput::make('seccion'),

                TextInput::make('tipo_avance'),

                TextInput::make('estado')
                    ->required()
                    ->default('registrado'),

                DateTimePicker::make('fecha_avance'),

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

                TextColumn::make('tipo_avance')
                    ->label('Tipo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('estado')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('fecha_avance')
                    ->dateTime()
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
