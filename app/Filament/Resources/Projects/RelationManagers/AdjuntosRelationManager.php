<?php

namespace App\Filament\Resources\Projects\RelationManagers;

use Filament\Actions\BulkActionGroup;
use Filament\Actions\CreateAction;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Forms\Components\KeyValue;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\Toggle;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class AdjuntosRelationManager extends RelationManager
{
    protected static string $relationship = 'adjuntos';

    public function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('titulo')
                    ->label('Título')
                    ->required()
                    ->maxLength(255),

                Select::make('tipo')
                    ->label('Tipo')
                    ->options([
                        'demo' => 'Demo',
                        'repo' => 'Repositorio',
                        'doc' => 'Documento',
                        'file' => 'Archivo',
                        'link' => 'Enlace',
                        'image' => 'Imagen',
                        'video' => 'Vídeo',
                        'other' => 'Otro',
                    ])
                    ->searchable()
                    ->native(false)
                    ->required(),

                TextInput::make('grupo')
                    ->label('Grupo')
                    ->maxLength(255),

                TextInput::make('subtitulo')
                    ->label('Subtítulo')
                    ->maxLength(255),

                Textarea::make('descripcion')
                    ->label('Descripción')
                    ->rows(4)
                    ->columnSpanFull(),

                // URL flexible para recursos externos.
                TextInput::make('url')
                    ->label('URL')
                    ->placeholder('https://ejemplo.com/recurso')
                    ->helperText('Pega una URL completa. Se recortan espacios automáticamente.')
                    ->maxLength(2048)
                    ->columnSpanFull()
                    ->dehydrateStateUsing(fn($state) => filled($state) ? trim($state) : null)
                    ->rule('nullable')
                    ->rule('string')
                    ->rule('max:2048'),

                TextInput::make('nombre_archivo')
                    ->label('Nombre de archivo')
                    ->maxLength(255),

                TextInput::make('mime_type')
                    ->label('MIME type')
                    ->maxLength(255),

                TextInput::make('icono')
                    ->label('Icono')
                    ->maxLength(100),

                TextInput::make('origen')
                    ->label('Origen')
                    ->required()
                    ->default('manual')
                    ->maxLength(255),

                TextInput::make('orden')
                    ->label('Orden')
                    ->required()
                    ->numeric()
                    ->default(0),

                Toggle::make('es_visible')
                    ->label('Visible')
                    ->default(true),

                Toggle::make('es_destacado')
                    ->label('Destacado')
                    ->default(false),

                KeyValue::make('metadata')
                    ->label('Metadata')
                    ->keyLabel('Clave')
                    ->valueLabel('Valor')
                    ->addActionLabel('Añadir metadata')
                    ->columnSpanFull(),
            ])
            ->columns(2);
    }

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('titulo')
            ->defaultSort('orden')
            ->columns([
                TextColumn::make('orden')
                    ->label('Orden')
                    ->numeric()
                    ->sortable(),

                TextColumn::make('titulo')
                    ->label('Título')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('tipo')
                    ->label('Tipo')
                    ->badge()
                    ->sortable(),

                TextColumn::make('grupo')
                    ->label('Grupo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('nombre_archivo')
                    ->label('Archivo')
                    ->searchable()
                    ->toggleable(),

                TextColumn::make('url')
                    ->label('URL')
                    ->limit(50)
                    ->tooltip(fn($record) => $record->url)
                    ->toggleable(),

                IconColumn::make('es_visible')
                    ->label('Visible')
                    ->boolean(),

                IconColumn::make('es_destacado')
                    ->label('Destacado')
                    ->boolean(),

                TextColumn::make('updated_at')
                    ->label('Actualizado')
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
